@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content" style="padding-left: 0px; padding-right: 0px;">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="media">
                            <div class="media-left">
                                <img src="{{ asset('assets/images/igloo.png') }}" class="media-object" style="width:60px">
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">IGLOO</h3>
                                <p><i>A world of Great Taste!!</i></p>
                            </div>
                        </div>
                        <div class="box-tools pull-right">
                            <a href="tel:{{ $ticket->phone_number }}" class="btn btn-danger btn-flat"> <i class="fa fa-phone"></i></a>
                        </div>
                    </div>
                   
                    <div class="box-body no-padding">
                        <!-- <div class="box-header">
                            <h3 class="box-title text-center"><center>Edit Order Form of <b>{{ Auth::user()->name }}</b></center></h3>
                        </div> -->
                        <p class="text-center">Edit Order Form of <b>{{ Auth::user()->name }}</b></p>
                      
                        <ul class="nav nav-pills nav-stacked">
                            <li style="padding: 5px;"><i class="fa fa-shopping-cart text-green"></i> Order ID: <b>{{ $ticket->id }}</b></li>
                            <li style="padding: 5px;"><i class="fa fa-user text-green"></i> Name: <b>{{ $ticket->customer_name }}</b></li>
                            <li style="padding: 5px;"><i class="fa fa-phone text-green"></i> Mobile: <b>{{ $ticket->phone_number }}</b></li>
                            <li style="padding: 5px;"><i class="fa fa-address-card-o text-green"></i> Address: <b>{{ $ticket->customer_address }}</b></li>
                            <li style="padding: 5px;"><i class="fa fa-user text-green"></i> Supervisor: @if(isset($ticket->svAssigned))<b>{{ $ticket->svAssigned->name }}</b>@endif</li>
                            <li style="padding: 5px;"><i class="fa fa-user-o text-green"></i> Assigned: @if(isset($ticket->dbAssigned))<b>{{ $ticket->dbAssigned->name }}</b> @else<b class="text-red">Doesn't Assigned</b>@endif</li>
                            <li style="padding: 5px;"><i class="fa fa-percent text-green"></i> Discount: <b>{{ $ticket->discount }}</b></li>
                            <li style="padding: 5px;"><i class="fa fa-gift text-green"></i> Gift: <b>{{ $ticket->gift }}</b></li>
                            <li style="padding: 5px;">
                                <span class="fa-stack fa-xs">
                                    <i class="fa fa-certificate fa-stack-2x text-red"></i>
                                    <span class="fa fa-stack-1x fa-inverse">৳</span>
                                </span> Total Price: <b>{{ $ticket->total_price }} Taka</b>
                            </li>
                            <li style="padding: 5px;"><i class="fa fa-credit-card text-green"></i> Payment Status: <b>{{ $ticket->payment_status }}</b></li>
                            @if($ticket->online_payment == 'Yes')
                                <li style="padding: 5px;"><i class="fa fa-credit-card text-red"></i> <b>Online Payment Done</b></li>
                            @endif
                            <li style="padding: 5px;"><i class="fa fa-bar-chart text-green"></i> Delivery Status: <b class="bg-danger">{{ $ticket->delivery_status }}</b></li>
                            <li style="padding: 5px;"><i class="fa fa-clock-o text-green"></i> Delivery DateTime: <b>{{ $ticket->delivery_time }}</b></li>
                            <!-- <li style="padding: 5px;"><i class="fa fa-product-hunt text-green"></i> Product: <b>{{ $ticket->product_model }}</b></li> -->
                            
                            <!-- <li style="padding: 5px;"><i class="fa fa-dollar text-green"></i> Price: <b>{{ $ticket->total_price }} Taka</b></li> -->
                            <div class="box box-danger">
                            @if(isset($ticket->product_detail))
                                <?php
                                    $productDecode = json_decode($ticket->product_detail);
                                ?>
                                @if(json_last_error() == JSON_ERROR_NONE)
                                    @foreach($productDecode as $value)
                                        <li style="padding: 5px;"><i class="fa fa-product-hunt text-red"></i> <b>{{ $value->Name }}</b><span class="label label-danger pull-right">{{ $value->Qty }} @if(isset($value->Unit)) {{ $value->Unit }} @endif</span></li>
                                    @endforeach
                                @endif
                            @endif
                            </div>
                        </ul>
                        
                        <div class="box box-success">
                            <div class="box-header">
                                <h3 class="box-title">Select and Submit</h3>
                            </div>
                            <div class="box-body">
                                {!! Form::model($ticket, ['url' => "order/admin/$ticket->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}        
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="form-group {{ $errors->has('app_user_id') ? 'has-error' : ''}}">
                                            <div class="col-xs-12 col-sm-12">
                                                {!! Form::select('app_user_id', $appUserList, null, ['class' => 'form-control','placeholder' => 'Please Select a Delivery Boy']) !!}
                                                <span class="text-danger">
                                                    {{ $errors->first('app_user_id') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                 {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-flat btn-block']) !!}
                            </div>
                        </div>

                        <div class="box box-warning">
                            <ul class="nav nav-pills nav-stacked">
                                @foreach($ticket->ticketDetails as $ticketDetail)
                                	<li style="padding: 5px;"><i class="fa fa-circle text-green"></i> <b>{{ $ticketDetail->created_at }}</b>: {{ $ticketDetail->remarks }}</li>              
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection