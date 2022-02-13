<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:dashboard.categories.index')->only('index');
        $this->middleware('can:dashboard.categories.show')->only('show');
        $this->middleware('can:dashboard.categories.create')->only('create','store');
        $this->middleware('can:dashboard.categories.edit')->only('edit','update');
        $this->middleware('can:dashboard.categories.destroy')->only('destroy');
        $this->middleware('can:dashboard.categories.files')->only('files');
    }


    public function index()
    {
        return view('dashboard.categories.index');
    }

    
    public function create()
    {
        return view('dashboard.categories.create');
    }

    
    public function store(Request $request)
    {

    }

    
    public function show(Category $category)
    {
        return view('dashboard.categories.show', compact('category'));
    }

    
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

 
    public function update(Request $request, Category $category)
    {

    }

    
    public function destroy(Category $category)
    {

    }

    public function files(Category $category, Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        if ($category->images->count() < 4 ) {
            $url = Storage::put('categories', $request->file('file'));

            $category->images()->create([
                'url' => $url,
            ]);
        }
    }
}
