<?php

namespace App\Http\Controllers;

use App\Models\Multipic;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class MultipicController extends Controller
{
    public function index()
    {
        $multipics = Multipic::latest()->paginate(5);
        return view('admin.multipic.index', compact('multipics'));
    }

    public function add(Request $request)
    {
        $multipic_images = $request->file('image');
        if ($multipic_images) {
            foreach ($multipic_images as $image) {
                $name_gen = hexdec(uniqid()) . '.' . $image->extension();
                Image::make($image)->resize(300, 200)->save('image/multipic/' . $name_gen);
                $last_img = 'image/multipic/' . $name_gen;
                $multipic = new Multipic();
                $multipic->image = $last_img;
                $multipic->save();
            }
        }

        return Redirect()->back()->with('success', 'Multipic successfully created');
    }
}
