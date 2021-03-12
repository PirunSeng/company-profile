<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function add(Request $request) {
        $validateData = $request->validate([
            'name' => 'required|unique:categories'
        ],
        [
            'name.required' => 'Custom validation error message for required'
        ],
        [
            'name.unique' => 'Custom validation error message for unique'
        ]);

        // Category::insert([
        //     'name' => $request->name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        $category = new Category();
        $category->name = $request->name;
        $category->user_id = Auth::user()->id;
        $category->save();

        return Redirect()->back()->with('success', 'Successfully created');
    }
}
