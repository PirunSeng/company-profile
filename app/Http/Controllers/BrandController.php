<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands|min:4',
            'logo' => 'required|mimes:jpg,bmp,png'
        ]);

        $brand = new Brand();
        $brand_image = $request->file('logo');
        if ($brand_image) {
            // without Intervention/image pacakge
            // $name_gen = hexdec(uniqid());
            // $img_ext = strtolower($brand_image->extension());
            // $img_name = $name_gen . '.' . $img_ext;
            // $upload_location = 'image/brand/'; // inside public directory
            // $last_img = $upload_location . $img_name;
            // $brand_image->move($upload_location, $img_name);
            // $brand->logo = $last_img;

            // with Intervention/image pacakge
            $name_gen = hexdec(uniqid()) . '.' . $brand_image->extension();
            Image::make($brand_image)->resize(300, 200)->save('image/brand/' . $name_gen);
            // Image::make($brand_image)->save('image/brand/' . $name_gen); // not resize
            $last_img = 'image/brand/' . $name_gen;
            $brand->logo = $last_img;
        }

        $brand->name = $request->name;
        $brand->save();

        return Redirect()->back()->with('success', 'Brand successfully created');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:4',
            'logo' => 'mimes:jpg,bmp,png'
        ]);

        $old_logo = $request->old_logo;
        $brand_image = $request->file('logo');
        if ($old_logo && $brand_image) {
            unlink($old_logo);
        }

        $brand = Brand::find($id);

        if ($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->extension());
            $img_name = $name_gen . '.' . $img_ext;
            $upload_location = 'image/brand/'; // inside public directory
            $last_img = $upload_location . $img_name;
            $brand_image->move($upload_location, $img_name);

            $brand->update([
                'name' => $request->name,
                'logo' => $last_img
            ]);
        } else {
            $brand->update([
                'name' => $request->name
            ]);
        }

        return Redirect()->back()->with('success', 'Brand successfully updated');
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        $logo = $brand->logo;
        if ($logo) {
            unlink($logo);
        }

        $brand->delete();

        return Redirect()->back()->with('success', 'Brand successfully deleted');
    }
}
