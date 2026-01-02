<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ApprovalBandModel;
use App\Models\EventModel;

class ApprovalBandController extends BaseController
{
    public function index($eventId)
    {
        // echo $eventId;
        // exit;
        $event =  new EventModel();
        $event = $event->find($eventId);

        if (!$event) {
            return redirect()->to('/admin/events');
        }

        $bondApproval = new ApprovalBandModel();
        $bands = $bondApproval->where('event_id', $eventId)
            ->orderBy('band_order', 'ASC')
            ->findAll();

        return view('admin/approval_bands/index', [
            'event' => $event,
            'bands' => $bands
        ]);
    }

    public function store($eventId)
    {
        // echo $eventId
        $order = $this->request->getPost('band_order');
        $role  = $this->request->getPost('role');

        if (!$order || !$role) {
            return redirect()->back()->with('error', 'All fields are required');
        }

        $bandModel = new ApprovalBandModel();

        // fecth duplicate first check is it exists
        $orderExists = $bandModel->where('event_id', $eventId)
            ->where('band_order', $order)
            ->first();

        if ($orderExists) {
            return redirect()->back()
                ->with('error', 'This approval order already exists');
        }

        // and also check the duplicate for role 
        $roleExists = $bandModel->where('event_id', $eventId)
            ->where('role', $role)
            ->first();

        if ($roleExists) {
            return redirect()->back()
                ->with('error', 'This role is already in approval flow');
        }

        $bandModel->insert([
            'event_id'   => $eventId,
            'band_order' => $order,
            'role'       => $role
        ]);

        return redirect()->back()->with('success', 'Approval band added');
    }
}
