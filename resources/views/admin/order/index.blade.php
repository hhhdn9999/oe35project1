@extends('admin.layout.master')
@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ trans('message.manageorder')}}</strong>
                </div>
                <div class="card-body">
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th scope="col">{{ trans('message.id')}}</th>
                                <th scope="col">{{ trans('message.username')}}</th>
                                <th scope="col">{{ trans('message.total_price')}}</th>
                                <th scope="col">{{ trans('message.status')}}</th>
                                <th scope="col">{{ trans('message.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($orders))
                                @foreach($orders as $order)
                                    <tr>
                                        <td scope="row">{{ $order->id }}</td>
                                        <td scope="row">{{ $order->name_user }}</td>
                                        <td scope="row">{{ $order->total_price }}</td>
                                        <td scope="row">
                                            @if($order->status == 0)
                                                {{ 'Ordered' }}
                                            @endif
                                            @if($order->status == 1)
                                                {{ 'Being transported' }}
                                            @endif
                                        </td>
                                        <td scope="row">
                                            @if($order->status == 0)
                                                <a class="btn btn-info" href="{{ route('order.accept', $order->id) }}">{{ trans('message.accept')}}</a>
                                            @endif
                                            @if($order->status == 1)
                                                <p class="btn btn-dark">{{ trans('message.done')}}</p>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <p>
                        @if(Session::has('message_delete'))
                            {{"Delete Success"}}
                            @if(Session::forget('message_delete'))
                            @endif
                        @endif
                    </p>
                    @if(isset($orders))
                        {{ $orders->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
