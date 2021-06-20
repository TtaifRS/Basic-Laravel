<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function AllCat()
    {
        return view('admin.category.index');
    }

    public function AddCat(Request $request)
    {
        $validated = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:25',
            ],
            [
                'category_name.required' => 'Please Input Catergory Name'
            ]
        );

        //eloquent ORM insert first way

        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        //eloquent ORM insert main way
        $categoy = new Category;
        $categoy->category_name = $request->category_name;
        $categoy->user_id = Auth::user()->id;
        $categoy->save();

        return Redirect()->back()->with('success', 'Category Inserted Successfully');
    }
}
