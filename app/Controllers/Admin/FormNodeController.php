<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FormNodeModel;
use App\Models\EventModel;

class FormNodeController extends BaseController
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

        $formFields = new FormNodeModel();
        $formNodes = $formFields->where('event_id', $eventId)->findAll();

        return view('admin/form_nodes/index', [
            'event' => $event,
            'nodes' => $formNodes
        ]);
    }

    public function store($eventId)
    {
        $data = [
            'event_id'      => $eventId,
            'label'         => $this->request->getPost('label'),
            'field_name'    => $this->request->getPost('field_name'),
            'field_type'    => $this->request->getPost('field_type'),
            'field_options' => $this->request->getPost('field_options'),
            'required'      => $this->request->getPost('required') ? 1 : 0,
        ];

        if (!$data['label'] || !$data['field_name'] || !$data['field_type']) {
            return redirect()->back()->with('error', 'Label, field name and type are required');
        }

        (new FormNodeModel())->insert($data);

        return redirect()->back()->with('success', 'Form field added');
    }
}
