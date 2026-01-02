<?php

namespace App\Controllers\Approver;

use App\Controllers\BaseController;
use App\Models\ApprovalBandModel;
use App\Models\RegistrationModel;
use App\Models\ApprovalModel;

class DashboardController extends BaseController
{

    private function getCurrentApprovalBand($registration)
    {
        // Get all approval bands first 
        $bands = new ApprovalBandModel();
        $bands = $bands->where('event_id', $registration['event_id'])
            ->orderBy('band_order', 'ASC')
            ->findAll();

        if (!$bands) {
            return null;
        }

        $approvedBands = new ApprovalModel();
        $approvedBandIds = $approvedBands->where('registration_id', $registration['id'])
            ->where('decision', 'approved')
            ->findColumn('band_id');

        foreach ($bands as $band) {
            if (!in_array($band['id'], $approvedBandIds ?? [])) {
                return $band;
            }
        }

        return null;
    }

    public function index()
    {
        $role = session()->get('role');
        $bands = new ApprovalBandModel();
        $bands = $bands->where('role', $role)
            ->findAll();

        if (!$bands) {
            return view('approver/dashboard', ['registrations' => []]);
        }

        $eventIds = array_column($bands, 'event_id');

        // get akl the pending registrations fir the events 
        $allRegistrations = new RegistrationModel();
        $registrations = $allRegistrations->select('registrations.*, users.name as user_name, events.name as event_name')
            ->join('users', 'users.id = registrations.user_id')
            ->join('events', 'events.id = registrations.event_id')
            ->whereIn('registrations.event_id', $eventIds)
            ->where('registrations.status', 'pending')
            ->findAll();

        return view('approver/dashboard', compact('registrations'));
    }


    // for manage the statue approved 
    public function approve($registrationId)
    {
        $data =  $this->processDecision($registrationId, 'approved');
        // var_dump($data);
        // exit;
        return redirect()->back()->with('success', 'Approved successfully');
    }

    // for manage the statue approved 
    public function reject($registrationId)
    {
        $value =  $this->processDecision($registrationId, 'rejected');
        // var_dump($value);
        // exit;
        return redirect()->back()->with('success', 'Rejected successfully');
    }

    private function processDecision($registrationId, $decision)
    {
        $userId = session()->get('user_id');
        $role   = session()->get('role');

        $regModel = new RegistrationModel();
        $approvalModel = new ApprovalModel();

        $registration = $regModel->find($registrationId);
        if (!$registration || $registration['status'] !== 'pending') {
            return;
        }

        $currentBand = $this->getCurrentApprovalBand($registration);


        if (!$currentBand) {
            return;
        }
        if ($currentBand['role'] !== $role) {
            return;
        }

        // Save the record
        $isApproved = $approvalModel->insert([
            'registration_id' => $registrationId,
            'approved_by'     => $userId,
            'band_id'         => $currentBand['id'],
            'decision'        => $decision,
            'remarks'         => $this->request->getPost('remarks')
        ]);


        // If rejected the update the status and return 
        if ($decision === 'rejected') {
            $regModel->update($registrationId, ['status' => 'rejected']);
            return;
        } elseif ($decision === 'approved') {
            $regModel->update($registrationId, ['status' => 'approved']);
            return;
        }



        // Check if more bands exist
        $nextBand = new ApprovalBandModel();
        $nextBand = $nextBand->where('event_id', $registration['event_id'])
            ->where('band_order >', $currentBand['band_order'])
            ->orderBy('band_order', 'ASC')
            ->first();

        // Final approval
        if (!$nextBand) {
            $regModel->update($registrationId, ['status' => 'approved']);
        }
    }
}
