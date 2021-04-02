<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class HomeController extends Controller
{
    public function slider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function createSlider()
    {
        return view('admin.slider.create');
    }

    public function storeSlider(Request $request)
    {
        $slider = new Slider();
        $slider_image = $request->file('image');
        if ($slider_image) {
            $name_gen = hexdec(uniqid()) . '.' . $slider_image->extension();
            Image::make($slider_image)->resize(1920, 1088)->save('image/slider/' . $name_gen);
            $last_img = 'image/slider/' . $name_gen;
            $slider->image = $last_img;
        }
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->save();

        return Redirect()->route('home.slider')->with('success', 'Slider successfully created');
    }
}
