<?php

namespace App\Http\Controllers;

use App\Models\Slider;

class HomeController extends Controller
{
    public function slider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }
}
