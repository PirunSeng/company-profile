<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Eloquent ORM approach
        $categories = Category::latest()->paginate(5);
        // Query builder approach
        // $categories = DB::table('categories')->latest()->get();
        // $categories = DB::table('categories')
        //                 ->join('users', 'categories.user_id', 'users.id')
        //                 ->select('categories.id', 'categories.created_at', 'categories.name as cat_name', 'users.name')
        //                 ->latest()->paginate(5);

        $trashed_categories = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index', compact('categories', 'trashed_categories'));
    }

    public function add(Request $request)
    {
        $validateData = $request->validate(
            [
                'name' => 'required|unique:categories'
            ],
            [
                'name.required' => 'Custom validation error message for required'
            ],
            [
                'name.unique' => 'Custom validation error message for unique'
            ]
        );

        // There are two Eloquent ORM approach
        // Category::insert([
        //     'name' => $request->name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        $category = new Category();
        $category->name = $request->name;
        $category->user_id = Auth::user()->id;
        $category->save();

        // Query builder approach
        // $data = array();
        // $data['name'] = $request->name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'Successfully created');
    }

    public function edit($id)
    {
        // Eloquent ORM
        // $category = Category::find($id);
        // Query Builder
        $category = DB::table('categories')->where('id', $id)->first();

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Eloquent ORM
        // $category = Category::find($id);
        // $category->update(['name' => $request->name, 'user_id' => Auth::user()->id]);
        // Query builder
        $data = [];
        $data['name'] = $request->name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('categories')->with('success', 'Successfully updated');
    }

    public function softDelete($id)
    {
        $category = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Successfully soft deleted');
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Successfully restored');
    }

    public function delete($id)
    {
        $category = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Successfully permanently deleted');
    }
}
