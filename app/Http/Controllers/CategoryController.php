<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category = null) {

        return view('categories.index', compact('category'));
       
    }

    public function companies(Category $category = null) {
        
        if ($category !== null) {
            $companies = $category->companies()->paginate(4);
        }

        return view('categories.companies', compact('companies', 'category'));
    }

    public function show(Request $request, Category $category = null) {

        $city = City::where('slug',$request->city)->first();
        $search = $request->search;
        if($category !== null){
            return view('categories.show', compact('category','city','search'));
        }

        return redirect('directory');
    }

    public function home(Request $request) {
        $categories = Category::where('parent_id',null)->get();
        $city = City::where('slug',$request->city)->first();
        $search = $request->search;

        return view('directory', compact('categories','city','search'));
    }

    public function redirect(Category $category = null) {
        if($category !== null){
            //return redirect('categories.show');
            return back();
        }
        return redirect('directory');
    }
}
