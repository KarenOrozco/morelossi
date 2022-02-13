<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index() {
        $events = Event::All();

        return view('events', compact('events'));
    }
}
