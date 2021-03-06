<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\admin\AdminCategory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = AdminCategory::GetCategoryList();
        $result = array(
            'category'      => $category,
            'page_header'   => 'List of Category',
        );
        return view('admin.category.list', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = array(
            'page_header'   => 'Add Category Details',
        );
        return view('admin.category.create', compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = AdminLoginController::id();
        $category = new AdminCategory;
        $category->category_name = $request->category_name;
        $category->slug = str_slug($request->category_name,'-');
        $category->status = $request->status;
        $category->posted_by = $user_id;
        $category->save();
        //return redirect('my-admin/category');
        return redirect(route('category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = AdminCategory::findOrFail($id);
        $result = array(
            'page_header'   => 'Add Category Details',
            'record'        => $category,
        );
        return view('admin.category.edit', compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = AdminLoginController::id();
        $category = AdminCategory::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->posted_by = $user_id;
        $category->save();
        //return redirect('my-admin/category');
        return redirect(route('category.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = AdminCategory::findOrFail($id);
        $category->delete();
        //return redirect('my-admin/category');
        return redirect(route('category.index'));
    }
}
