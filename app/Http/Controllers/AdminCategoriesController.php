<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Http\Requests\AddCategoriesRequest;
use App\Http\Requests\EditCategoriesRequest;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['catelist'] = Categories::orderby('id', 'asc')->paginate(Config::get('app.paginate'));

        return view('admin.categories.listcategories',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['catelist'] = Categories::all();

        return view('admin.categories.addcategories',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCategoriesRequest $request)
    {
        $cate = new Categories;
        $cate->categories_name = $request->categories_name;
        $cate->parent_id = $request->parent_id;
        $cate->save();

        return redirect()->intended('admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id != null){
            $data['editcate'] = Categories::find($id);
            $data['catelist'] = Categories::all();

            return view('admin.categories.editcategories',$data);
        }
        else
        {
            return back()->withErrors( __('message.edit'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCategoriesRequest $request, $id)
    {
        if($id != null){
            $cate = Categories::find($id);
            $cate->categories_name = $request->categories_name;
            $cate->parent_id = $request->parent;
            $cate->save();

            return redirect()->intended('admin/categories');
        }
        else
        {
            return back()->withErrors( __('message.edit'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id != null){
            Categories::destroy($id);

             return redirect()->intended('admin/categories');
        }
        else
        {
            return back()->withErrors( __('message.xoa'));
        }
    }
}
