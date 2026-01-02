<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventModel;

class EventController extends BaseController
{
    public function index()
    {
        $allEvents = new EventModel();
        $events = $allEvents->orderBy('id', 'desc')->findAll();
        return view('admin/events/index', compact('events'));
    }

    public function create()
    {
        return view('admin/events/create');
    }

    public function store()
    {
        $insertEvent = new EventModel();
        $insertEvent->insert([
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
        ]);

        return redirect()->to('/admin/events');
    }

    public function edit($id)
    {
        // echo $id;
        $eventModel = new EventModel();
        $event = $eventModel->find($id);

        if (!$event) {
            return redirect()->to('/admin/events')->with('error', 'Event not found');
        }

        return view('admin/events/edit', compact('event'));
    }

    // update function  for yte event
    public function update($id)
    {
        $eventModel = new EventModel();
        $event = $eventModel->find($id);
        // var_dump($event);
        // exit;
        if (!$event) {
            return redirect()->to('/admin/events')->with('error', 'Event not found');
        }
        $updateData = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
        ];
        $eventModel->update($id, $updateData);
        return redirect()->to('/admin/events');
    }
}
