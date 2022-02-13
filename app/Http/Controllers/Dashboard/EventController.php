<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:dashboard.events.index')->only('index');
        $this->middleware('can:dashboard.events.show')->only('show');
        $this->middleware('can:dashboard.events.create')->only('create','store');
        $this->middleware('can:dashboard.events.edit')->only('edit','update');
        $this->middleware('can:dashboard.events.destroy')->only('destroy');
        $this->middleware('can:dashboard.events.files')->only('files');
    }


   
    public function index()
    {
        //
    }

   
    public function create()
    {
        return view('dashboard.events.create');
    }


    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }

    public function files(Event $event, Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        if ($event->images->count() < 4 ) {
            $url = Storage::put('events', $request->file('file'));

            $event->images()->create([
                'url' => $url,
            ]);
        }
    }
}
