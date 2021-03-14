<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function add(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:brands|min:4',
            'logo' => 'mimes:jpg,bmp,png'
        ]);

        $brand_image = $request->file('logo');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->extension());
        $img_name = $name_gen . '.' . $img_ext;
        $upload_location = 'image/brand/'; // inside public directory
        $last_img = $upload_location . $img_name;
        $brand_image->move($upload_location, $img_name);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->logo = $last_img;
        $brand->save();

        return Redirect()->back()->with('success', 'Brand successfully created');
    }
}
