<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Models\FormNodeModel;
use App\Models\QuotaModel;
use App\Models\RegistrationModel;
use App\Models\RegistrationFormValueModel;


class EventController extends BaseController
{
    // list all upcoming events only 
    public function index()
    {
        $events = new EventModel();
        $events = $events->where('end_date >', date('Y-m-d'))->findAll();
        return view('user/events/index', compact('events'));
    }

    public function register($eventId)
    {
        $eventId = new EventModel();
        $event = $eventId->find($eventId);
        if (!$event) {
            return redirect()->to('/user/events');
        }

        $formFields = new FormNodeModel();
        $fields = $formFields->where('event_id', $eventId)->findAll();

        return view('user/events/register', [
            'event'  => $event,
            'fields' => $fields
        ]);
    }



    public function submit($eventId)
    {
        $userId = session()->get('user_id');
        $role   = session()->get('role');

        $quotaModel = new QuotaModel();
        $regModel   = new RegistrationModel();

        // Check quotafirst
        $quota = $quotaModel
            ->where('event_id', $eventId)
            ->where('role', $role)
            ->first();

        $count = $regModel
            ->where('event_id', $eventId)
            ->where('status !=', 'rejected')
            ->countAllResults();

        $status = ($quota && $count >= $quota['max_participants'])
            ? 'waitlisted'
            : 'pending';

        // insert data in the registration table 
        $registrationId = $regModel->insert([
            'event_id' => $eventId,
            'user_id'  => $userId,
            'status'   => $status
        ]);

        // save the data in dynamic table fields
        $fields = new FormNodeModel();
        $fields = $fields->where('event_id', $eventId)->findAll();

        $valueModel = new RegistrationFormValueModel();

        foreach ($fields as $field) {
            $valueModel->insert([
                'registration_id' => $registrationId,
                'field_name'      => $field['field_name'],
                'field_value'     => $this->request->getPost($field['field_name'])
            ]);
        }

        return redirect()->to('/user/events')
            ->with('success', 'Registration submitted');
    }
}
