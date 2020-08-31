<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('message.title')}}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

@include('pages.components.header')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="order-summary clearfix">
                <div class="section-title">
                    <h3 class="title">{{ trans('message.orderdetail')}}</h3>
                </div>
                    <table class="shopping-cart-table table">
                        <thead>
                            <tr>
                                <th class="text-center">{{ trans('message.productname')}}</th>
                                <th class="text-center">{{ trans('message.image')}}</th>
                                <th class="text-center">{{ trans('message.categoriesname')}}</th>
                                <th class="text-center">{{ trans('message.des')}}</th>
                                <th class="text-center">{{ trans('message.price')}}</th>
                                <th class="text-center">{{ trans('message.quantity')}}</th>
                                <th class="text-center">{{ trans('message.total')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($orderdetail))
                                @foreach($orderdetail as $orderdetailrow)
                                    <tr>
                                        <td class="thumb text-center">{{$orderdetailrow->product_name}}</td>
                                        <td class="thumb text-center"><img src="{{asset('image/'.$orderdetailrow->product_img)}}" alt="error"></td>
                                        <td class="thumb text-center">{{$orderdetailrow->categories_name}}</td>
                                        <td class="thumb text-center">{{$orderdetailrow->description}}</td>
                                        <td class="thumb text-center">{{$orderdetailrow->price}} {{ trans('message.vnd')}}</td>
                                        <td class="thumb text-center">{{$orderdetailrow->quantity}}</td>
                                        <td class="thumb text-center">{{$orderdetailrow->order_product_totalprice}} {{ trans('message.vnd')}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="pull-right">
                        <strong class="thumb text-center">{{ trans('message.ordertotal')}} {{$orderdetailrow->total_price}} {{ trans('message.vnd')}}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.components.footer')
