<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Config;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(Config::get('app.paginate'));
        $data = [
            'users' => $user
        ];

        return view('admin.users.index', $data);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if( $user != null ){
            $user->delete();
            Session::put('message_delete', 'Success');
            return redirect()->back();
        } else {
            return back()->withErrors( trans('message.fail'));
        }
    }
}
