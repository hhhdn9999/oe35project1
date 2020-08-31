<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Suggest;
use App\User;
use Session;
use Auth;
use App\Http\Requests\AddSuggestRequest;
class SuggestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['catelist'] = Categories::all();

        return view('suggest.suggest',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSuggestRequest $request)
    {
        $file_name = $request->file('product_img')->getClientOriginalName();
        $suggest = new Suggest;
        $suggest->product_name = $request->product_name;
        $suggest->product_img = $file_name;
        $suggest->description = $request->description;
        $suggest->reason = $request->reason;
        $suggest->price = $request->price;
        $suggest->status = 1;
        $suggest->categories_id = $request->categories_id;
        $suggest->user_id  = Auth::user()->id;
        $request->file('product_img')->move('image',$file_name);
        $suggest->save();

        return redirect('/homepage');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
