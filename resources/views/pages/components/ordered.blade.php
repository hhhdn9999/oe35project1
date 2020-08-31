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
                    <h3 class="title">{{ trans('message.ordered')}}</h3>
                </div>
                    <table class="shopping-cart-table table">
                        <thead>
                            <tr>
                                <th class="text-center">{{ trans('message.nameuser')}}</th>
                                <th class="text-center">{{ trans('message.total')}}</th>
                                <th class="text-center">{{ trans('message.orderdate')}}</th>
                                <th class="text-center">{{ trans('message.status')}}</th>
                                <th class="text-center">{{ trans('message.orderdetail')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($ordered))
                                @foreach($ordered as $order)
                                    <tr>
                                        <td class="thumb text-center">{{ $order->name_user}}</td>
                                        <td class="thumb text-center">{{ $order->total_price }}</td>
                                        <td class="thumb text-center">{{ $order->created_at }}</td>
                                        <td class="thumb text-center">
                                            @if($order->status == 0)
                                                {{ 'Ordered' }}
                                            @endif
                                            @if($order->status == 1)
                                                {{ 'Being transported' }}
                                            @endif
                                        </td>
                                        <td class="thumb text-center">
                                            <a href="{{route('orderdetail', $order->id)}}"> <button class="btn btn-info">{{ trans('message.orderdetail')}}</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.components.footer')
