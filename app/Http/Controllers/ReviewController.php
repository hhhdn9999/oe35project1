<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\FormReviewRequest;
use App\Models\Review;
use Auth;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    public function store_review(FormReviewRequest $request, $id)
    {
        if(isset(Auth::user()->id))
        {
            $reviews = Review::where('product_id', '=' ,$id)->select()->get();
            $totalStar = 0;
            $ave = 0;
            $totalreview = 1;
            foreach ($reviews as $review) {
                $totalStar += $review->star;
                $totalreview++;
            }
            $totalStar += $request->review_star;
            if($totalreview != 0) $ave = ($totalStar / $totalreview);

            $review = new Review();
            $review->comment = $request->review_comment;
            $review->star = $request->review_star;
            $review->total_star = $ave;
            $review->product_id = $id;
            $review->user_id = Auth::user()->id;


            $review->save();

            return redirect()->back();
        } else {

            return Redirect::route('login');
        }
    }

    public function edit_review($id_product, $id_review)
    {
        $products = Product::where('id', '=' ,$id_product)->get();

        $reviews = Review::with('users:id,name');
        $reviews = $reviews->where('product_id', '=' ,$id_product)->paginate(3);

        $reviews_edits = Review::findOrFail($id_review);
        return view('pages.components.detail_product', compact('products', 'reviews', 'reviews_edits'));
    }

    public function update_review(RequestReview $requestReview, $id_product, $id_review)
    {
        $review = Review::findOrFail($id_review);
        $review->review_comment = $requestReview->review_comment;
        $review->review_star = $requestReview->review_star;
        $review->product_id = $id_product;
        $review->user_id = Auth::user()->id;
        $review->save();

        return redirect(route('get_products_detail', $id_product));
    }

    public function delete_review($id_product, $id_review)
    {
        $review = Review::find($id_review);
        $review->delete();

        return redirect()->back();
    }
}
