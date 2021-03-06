@extends('back.base_layouts.app')

@section('content')

<ol class="breadcrumb bc-3  noPrint" >
    <li>
    <a href="{{route('user.dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>

    <li>
        <a href="{{route('user.transactions.index')}}"><i class="fa-home"></i>@lang('site.transactions')</a>
        </li>

    <li class="active">

        <strong>@lang('site.transaction') {{$transaction->id}}</strong>
    </li>
</ol>

<div class="invoice">

    <div class="row">

        <div class="col-sm-6 invoice-left">



            <h4>@lang('site.provider_name') : {{$transaction->provider->first_name.' '.$transaction->provider->last_name}}</h4>

            <h4>@lang('site.shop_name') : {{$transaction->shop->name}}</h4>
            <h4>@lang('site.shop_address') : {{$transaction->shop->address}}</h4>


        </div>

        <div  class="col-sm-6 invoice-right">
                <h3 class="bold"> @lang('site.transaction_number') : {{$transaction->id}}</h3>
                @if ($transaction->type==0)
                <h3 style="margin-left:37px" class="bold">@lang('site.type'): @lang('site.debt') </h3>
                @else
                <h3 style="margin-left:37px" class="bold">@lang('site.type'): @lang('site.cash') </h3>
            @endif
            <h5 style="margin-left:40px;color:red">{{$transaction_date}}</h5>

        </div>

    </div>


    <hr class="margin" />




    <div class="margin"></div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th width="60%">@lang('site.product')</th>
                <th>@lang('site.quantity')</th>
                <th>@lang('site.price')</th>
                <th>@lang('site.total')</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($transaction->items as $index=> $item)
            <tr>
                <td class="text-center">{{++$index}}</td>
                <td>{{$item->product->name}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->product->price_to_sell}}</td>

                <td class="text-right">{{$item->price}}</td>
            </tr>
            @endforeach


        </tbody>
    </table>

    <div class="margin"></div>

    <div class="row">


        <div class="col-sm-6">

            <div class="invoice-left">

                <ul class="list-unstyled">
                    <li>
                       @lang('site.total') :
                        <strong>{{$transaction->total}}</strong>
                    </li>

                </ul>

                <br/>

                @if(auth()->user()->type===1)
                <ul class="list-unstyled">
                    @canany(['all-shoppermissions','status-usertransaction'])
                    @if($transaction->status===0)
                    <a href="{{route('user.transaction.status',$transaction->id)}}" class="btn btn-danger">
                        <i class="entypo-hourglass"> @lang('site.confirm_delivered')</i></a>
                    @else
                    <a class="btn btn-success"><i class="entypo-check"> @lang('site.delivered')</i></a>
                    @endif
                    @else

                    <a class="btn btn-primary disabled">
                        <i class="entypo-hourglass"> @lang('site.confirm_delivered')</i></a>
                    @endcan
                </ul>
                @else
                <ul class="list-unstyled">
                    @can('pay-usertransaction')
                    @if($transaction->is_paid === 0 )
                    <a href="{{route('user.transaction.paid',$transaction->id)}}" class="btn btn-danger"><i class="entypo-hourglass"> @lang('site.confirm_paid')</i></a>
                    @else
                    <a class="btn btn-success"><i class="entypo-check"> @lang('site.paid')</i></a>
                    @endif

                    @else
                    <a class="btn btn-primary disabled"><i class="entypo-hourglass"> @lang('site.confirm_paid')</i></a>

                    @endcan
                </ul>
                @endif

            </div>

        </div>

        <div class="col-sm-6">
            <div class="invoice_right ">

                <a href="javascript:window.print();" class="btn btn-primary btn-icon icon-left hidden-print pull-right">
                    @lang('site.print_invoice')
                    <i class="entypo-doc-text"></i>
                </a>

                &nbsp;

            </div>
        </div>

    </div>

</div>

@endsection
