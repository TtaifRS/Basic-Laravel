<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Image;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request)
    {
        $validaedData = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:png,jpg,jpeg'
            ],
            [
                'brand_name.required' => 'Please Input Brand Name',
                'brand_name.min' => "Brand Name longer then 4 Charecters"
            ]

        );

        $brand_image = $request->file('brand_image');

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());

        // $img_name = $name_gen . '.' . $img_ext;

        // $upload_location  = 'images/brand/';

        // $last_img = $upload_location . $img_name;

        // $brand_image->move($upload_location, $img_name);
        $name_gen = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300, 200)->save('images/brand/' . $name_gen);

        $last_img = 'images/brand/' . $name_gen;


        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);


        return Redirect()->back()->with('success', 'Brand added successfully');
    }


    public function EditBrand($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact("brands"));
    }

    public function UpdateBrand(Request $request, $id)
    {
        $validaedData = $request->validate(
            [
                'brand_name' => 'required|min:4',
            ],
            [
                'brand_name.required' => 'Please Input Brand Name',
                'brand_name.min' => "Brand Name longer then 4 Charecters"
            ]

        );

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if ($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());

            $img_name = $name_gen . '.' . $img_ext;

            $upload_location  = 'images/brand/';

            $last_img = $upload_location . $img_name;

            $brand_image->move($upload_location, $img_name);

            unlink($old_image);

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now(),
            ]);


            return Redirect()->back()->with('success', 'Brand Updated successfully');
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ]);
            return Redirect()->back()->with('success', 'Brand Updated successfully');
        }
    }


    public function DeleteBrand($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        $deleteBrand = Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted successfully');
    }
}
