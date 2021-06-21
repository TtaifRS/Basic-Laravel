<?php

namespace App\Http\Controllers;

use App\Models\MultiImg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class MultiImageController extends Controller
{
    public function MultiImage()
    {
        $images = MultiImg::all();
        return view('admin.multiImg.index', compact('images'));
    }


    public function StoreImage(Request $request)
    {
        $multi_images = $request->file('multi_image');

        foreach ($multi_images as $multi_image) {
            $name_gen = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
            Image::make($multi_image)->resize(300, 300)->save('images/multi/' . $name_gen);

            $last_img = 'images/multi/' . $name_gen;


            MultiImg::insert([
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
        }

        return Redirect()->back()->with('success', 'Images added successfully');
    }
}
