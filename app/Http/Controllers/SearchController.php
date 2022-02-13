<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $search = $request->search;
        $city = $request->city;
        $category = $request->category;

        $stores = Company::where('name', 'LIKE' ,'%' . $search . '%')
                                ->where('status', 4)
                                ->paginate(8);

        if($category !== 'all'){
            return redirect()->route('categories.show', compact('category','city','search'));
        }

        $categories = Category::where('parent_id',null)->get();
        return redirect()->route('directory', compact('categories','city','search'));
    }
}
