<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:dashboard.stores.index')->only('index');
        $this->middleware('can:dashboard.stores.showMyStore')->only('showMyStore');
        $this->middleware('can:dashboard.stores.create')->only('create','store');
        $this->middleware('can:dashboard.stores.edit')->only('edit','update');
        $this->middleware('can:dashboard.stores.destroy')->only('destroy');
        $this->middleware('can:dashboard.stores.files')->only('files');
    }

    public function index()
    {
        return view('dashboard.stores.index');
    }

 
    public function create()
    {
        return view('dashboard.stores.create');
    }

   
    public function store(Request $request)
    {
        //
    }


    public function showMyStore()
    {
        $store = Auth::user()->company;
        return view('dashboard.stores.show', compact('store'));
    }

  
    public function edit(Company $store)
    {
        return view('dashboard.stores.edit', compact('store') );
    }

   
    public function update(Request $request, Company $store)
    {
        //
    }

 
    public function destroy(Company $store)
    {
        //
    }


    public function files(Company $store, Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        if ($store->images->count() < 4 ) {
            $url = Storage::put('companies', $request->file('file'));

            $store->images()->create([
                'url' => $url,
            ]);
        }
    }

}
