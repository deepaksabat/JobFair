<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $title = trans('app.categories');
        $categories = Category::orderBy('id', 'desc')->get();

        return view('admin.categories', compact('title', 'categories'));
    }



    public function store(Request $request){
        $rules = [
            'category_name' => 'required',
        ];
        $this->validate($request, $rules);

        $slug = str_slug($request->category_name);
        $duplicate = Category::where('category_slug', $slug)->count();
        if ($duplicate > 0){
            return back()->with('error', trans('app.category_exists_in_db'));
        }

        $data = [
            'category_name' => $request->category_name,
            'category_slug' => $slug,
        ];

        Category::create($data);
        return back()->with('success', trans('app.category_created'));
    }


    public function edit($id)
    {
        $title = trans('app.edit_category');
        $category = Category::find($id);

        return view('admin.edit_category', compact('title', 'category'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'category_name' => 'required'
        ];
        $this->validate($request, $rules);

        $slug = str_slug($request->category_name);

        $duplicate = Category::where('category_slug', $slug)->where('id', '!=', $id)->count();
        if ($duplicate > 0){
            return back()->with('error', trans('app.category_exists_in_db'));
        }

        $data = [
            'category_name' => $request->category_name,
            'category_slug' => $slug,
        ];
        Category::where('id', $id)->update($data);
        return back()->with('success', trans('app.category_updated'));
    }


    public function destroy(Request $request)
    {
        $id = $request->data_id;

        $delete = Category::where('id', $id)->delete();
        if ($delete){
            return ['success' => 1, 'msg' => trans('app.category_deleted_success')];
        }
        return ['success' => 0, 'msg' => trans('app.error_msg')];
    }



}
