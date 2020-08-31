<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Redirect;
use Cart;
use DB;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function place_order()
    {
        if(isset(Auth::user()->id))
        {
            $data = Cart::content();
            $total = 0;
            $order = new Order();
            foreach ($data as $datum)
            {
                $total += ($datum->price * $datum->qty);
            };
            $order->user_id = Auth::user()->id;
            $order->total_price = $total;
            $order->save();

            $orderdetail = new OrderDetail();
            foreach ($data as $datum)
            {
                $orderdetail->product_id = $datum->id;
                $orderdetail->order_id = $order->id;
                $orderdetail->order_product_name = $datum->name;
                $orderdetail->order_product_totalprice = ($datum->qty * $datum->price);
                $orderdetail->quantity = $datum->qty;

                $orderdetail->save();
                Cart::destroy();

                $orderdetail = new OrderDetail();
            };
            $order->user_id = Auth::user()->id;
            $order->total_price = $total;
            $order->save();

            return Redirect::route('showcart');
        }else {

            return Redirect::route('login');
        }
    }

    public function ordered($id)
    {
        if( $id != null ){
            $ordered = DB::table('users')->join('order', 'users.id', '=', 'order.user_id');
            $ordered = $ordered->where('users.id', '=' ,$id)->get();
            $data = [
                'ordered' => $ordered,
            ];

            return view('pages.components.ordered', $data);
        } else {

            return back()->withErrors( trans('message.fail'));
        }
    }

    public function orderdetail($id)
    {
        if( $id != null ){
            $orderdetail = DB::table('order')->join('order_detail', 'order.id', '=', 'order_detail.order_id')
                                            ->join('product', 'product.id', '=', 'order_detail.product_id')
                                            ->join('categories', 'categories.id', '=', 'product.categories_id')
                                            ->where('order_detail.order_id', '=' ,$id)->get();
            $data = [
                'orderdetail' => $orderdetail,
            ];

            return view('pages.components.orderdetail', $data);
        } else {

            return back()->withErrors( trans('message.fail'));
        }
    }
}
