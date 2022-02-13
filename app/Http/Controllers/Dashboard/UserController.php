<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('can:dashboard.users.index')->only('index');
        $this->middleware('can:dashboard.users.show')->only('show');
        $this->middleware('can:dashboard.users.create')->only('create','store');
        $this->middleware('can:dashboard.users.edit')->only('edit','update');
        $this->middleware('can:dashboard.users.destroy')->only('destroy');
        $this->middleware('can:dashboard.users.logo')->only('logo');
    }

    public function index()
    {
        return view('dashboard.users.index');
    }

    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        //
    }

  
    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }

    
    public function update(Request $request, User $user)
    {
        //
    }

    
    public function destroy(User $user)
    {
        //
    }

    public function logo(User $user, Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        if ($user->image === null) {
            $url = Storage::put('users', $request->file('file'));

            $user->image()->create([
                'url' => $url,
            ]);
        }else{
            
        }
    }
}
