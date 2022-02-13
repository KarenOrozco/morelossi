<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('can:dashboard.index')->only('index');
    }

    public function index() {
        if (! Auth::user()->hasRole('admin')) {
            return redirect()->route('dashboard.stores.showMyStore');
        }
        return view('dashboard.index');
    }
}
