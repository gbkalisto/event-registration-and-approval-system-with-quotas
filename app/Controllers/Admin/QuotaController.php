<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\QuotaModel;
use App\Models\EventModel;

class QuotaController extends BaseController
{
    public function index($eventId)
    {
        // echo $eventId;  
        // exit;
        $event = new EventModel();
        $event = $event->find($eventId);

        if (!$event) {
            return redirect()->to('/admin/events');
        }

        $quotaModel = new QuotaModel();

        $quotas = $quotaModel->orderBy('id', 'desc')
            ->where('event_id', $eventId)
            ->findAll();

        return view('admin/quotas/index', [
            'event'  => $event,
            'quotas' => $quotas
        ]);
    }

    public function store($eventId)
    {
        // echo $eventId;
        // exit;
        $role = $this->request->getPost('role');
        $max  = $this->request->getPost('max_participants');

        if (!$role || !$max) {
            return redirect()->back()->with('error', 'All fields required');
        }

        $quotaModel = new QuotaModel();

        //  check the dupliocate role as per out events
        $exists = $quotaModel
            ->where('event_id', $eventId)
            ->where('role', $role)
            ->first();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Quota already defined for this role');
        }

        $quotaModel->insert([
            'event_id' => $eventId,
            'role' => $role,
            'max_participants' => $max
        ]);

        return redirect()->back()->with('success', 'Quota added successfully');
    }

    // delete quota
    public function delete($quotaId)
    {
        // echo $quotaId;
        // exit;
        $quotaModel = new QuotaModel();
        $quota = $quotaModel->find($quotaId);

        if (!$quota) {
            return redirect()->back()->with('error', 'Quota not found');
        }

        $quotaModel->delete($quotaId);

        return redirect()->back()->with('success', 'Quota deleted successfully');
    }
}
