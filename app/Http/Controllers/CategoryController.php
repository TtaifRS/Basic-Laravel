<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    public function AllCat()
    {
        $categories = Category::latest()->paginate(5);
        $trashCats = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index', compact('categories', 'trashCats'));
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

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        //eloquent ORM insert main way
        // $categoy = new Category;
        // $categoy->category_name = $request->category_name;
        // $categoy->user_id = Auth::user()->id;
        // $categoy->save();

        //Insert data with Query builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', 'Category Inserted Successfully');
    }


    public function EditCat($id)
    {
        $categories = Category::find($id);

        return view('admin.category.edit', compact('categories'));
    }


    public function UpdateCat(request $request, $id)
    {
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);

        return Redirect()->route('all.category')->with('success', 'Category Updated Successfully');
    }

    public function SoftDeleteCat($id)
    {
        $delete = Category::find($id)->delete();

        return Redirect()->back()->with('success', 'Category Removed Successfully');
    }


    public function RestoreCat($id)
    {
        $restore = Category::withTrashed()->find($id)->restore();

        return Redirect()->back()->with('success', 'Category Restored Successfully');
    }

    public function PermanentDeleteCat($id)
    {
        $permanentDelete = Category::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->back()->with('success', 'Category Permanently Deleted');
    }
}
