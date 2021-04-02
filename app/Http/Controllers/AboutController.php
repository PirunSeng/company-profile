<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function homeAbout()
    {
        $homeabouts = HomeAbout::latest()->get();
        return view('admin.home.about', compact('homeabouts'));
    }

    public function add()
    {
        return view('admin.home.about_add');
    }

    public function store(Request $request)
    {
        HomeAbout::create($request->all());
        return Redirect()->route('home.about')->with('success', 'HomeAbout successfully created');
    }

    public function edit($id)
    {
        $homeabout = HomeAbout::findOrFail($id);
        return view('admin.home.about_edit', compact('homeabout'));
    }

    public function update(Request $request, $id)
    {
        $homeabout = HomeAbout::findOrFail($id);
        $homeabout->update($request->all());
        return Redirect()->route('home.about')->with('success', 'HomeAbout successfully updated');
    }

    public function delete($id)
    {
        $homeabout = HomeAbout::findOrFail($id);
        $homeabout->delete();

        return Redirect()->back()->with('success', 'HomeAbout successfully deleted');
    }
}
