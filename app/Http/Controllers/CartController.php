<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index()
    {
        return view('pages.components.cart');
    }

    public function save_cart(Request $request)
    {

        $product_id = $request->product_id_hidden;
        $quantity = $request->quantity;
        $product = Product::where('id', $product_id)->first();

        $data['id'] = $product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product->product_name;
        $data['price'] = $product->price;
        $data['options']['image'] = $product->product_img;
        $data['weight'] = $product_id;

        Cart::add($data);

        return Redirect::route('showcart');
    }

    public function delete_cart($id)
    {
        if( $id != null ){
            Cart::update($id, 0);

            return Redirect::route('showcart');
        } else {

            return back()->withErrors( trans('message.fail'));
        }

    }

    public function update_cart(Request $request)
    {
        $rowId = $request->rowId;
        $quantity = $request->quantity;
        Cart::update($rowId, $quantity);

        return Redirect::route('showcart');
    }
}
