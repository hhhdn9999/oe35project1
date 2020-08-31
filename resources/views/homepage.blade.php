@extends('pages.layout.master')
@section('content')
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">{{ trans('message.Product')}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
        @if(isset($products))
            @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{'image/'.$product->product_img}}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{route('get_product_detail', $product->id)}}"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">{{$product->product_name}}</a></h6>
                            <h5>{{$product->price}}{{ trans('message.vnd')}}</h5>
                        </div>
                        <div class="review-rating pull-right">

                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                    </div>
                    </div>
                </div>
            @endforeach
        @endif
        </div>
        {{ $products->links() }}
    </div>
</section>
@stop
