<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Facades\Config;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = DB::table('product')
        ->orderby('product.id', 'asc')->paginate(Config::get('app.paginate12'));

        $categories = Categories::where('parent_id', '=', null)->orderBy('id', 'asc')->select()->get();
        $categorieChilds = Categories::where('parent_id', '!=', null)->orderBy('id', 'asc')->select()->get();

        $all_price_product = Product::orderby('price', 'asc')->select('id', 'price')->get();
        $all_categories_product = Categories::orderby('categories_name', 'asc')->select('id', 'categories_name')->get();

        $data = [
            'products' => $products,
            'categories' => $categories,
            'categorieChilds' => $categorieChilds,

            'prices' => $all_price_product,
            'all_categories_product' => $all_categories_product,
        ];

        return view('homepage', $data);
    }

    public function get_product_detail($id)
    {
        if( $id != null ){
            $products = DB::table('product')->where('product.id', '=' , $id)->select()->get();

            $reviews = DB::table('review')->join('product', 'product.id', '=', 'review.product_id')
                                        ->join('users', 'users.id', '=', 'review.user_id')
                                        ->where('product.id', '=' , $id)->select('review.id', 'review.user_id', 'product_id', 'comment', 'star', 'name_user', 'review.created_at')
                                        ->orderBy('review.id', 'desc')->paginate(Config::get('app.paginate'));
            $reviewstars = DB::table('review')->join('product', 'product.id', '=', 'review.product_id')->where('product.id', '=' , $id)->get();
            $data = [
                'reviewstars' => $reviewstars,
                'products' => $products,
                'reviews' => $reviews,
            ];

            return view('pages.components.detailproduct', $data);
        } else {

            return back()->withErrors( trans('message.fail'));
        }
    }

    public function check(Request $request)
    {
        $products = DB::table('product')->join('categories', 'categories.id', '=', 'product.categories_id')
        ->where('product.categories_id', '=', $request->r_categories )
        ->select();




        $categories = Categories::where('parent_id', '=', null)->orderBy('id', 'asc')->select()->get();
        $categorieChilds = Categories::where('parent_id', '!=', null)->orderBy('id', 'asc')->select()->get();

        $all_price_product = Product::orderby('price', 'asc')->select('id', 'price')->get();
        $all_categories_product = Categories::orderby('categories_name', 'asc')->select('id', 'categories_name')->get();

        $data = [
            'products' => $products,
            'categories' => $categories,
            'categorieChilds' => $categorieChilds,

            'prices' => $all_price_product,
            'all_categories_product' => $all_categories_product,
        ];

        return view('homepage', $data);
    }
}
