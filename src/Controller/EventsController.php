<?php

namespace App\Controller;

class EventsController extends AppController
{
    public function view($id)
    {
        $event = $this->Events->get($id, ['contain' => ['Videos']]);
        $this->set(compact('event'));
    }
}