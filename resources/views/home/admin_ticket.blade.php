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
                            <button onClick="window.location.reload();" class="btn btn-info btn-flat"> <i class="fa fa-refresh"></i></button>
                        </div>
                    </div>
                   
                    <div class="box-body no-padding">
                        <p class="text-center">Order List of <b>{{ Auth::user()->name }}</b></p>
                        

                        <ul class="nav nav-pills nav-stacked">
                            @foreach($adminTickets as $ticket)
                            	<?php
                            		if ($ticket->delivery_status == 'Order collected from depot') {
                            			$bgCSS = 'background-color: #FFA500;';
                            			$hoverCSS = '#FFA500';
                            		} else if ($ticket->delivery_status == 'On the way for order deliver') {
                            			$bgCSS = 'background-color: #FFFF00;';
                            			$hoverCSS = '#FFFF00';
                            		} else if ($ticket->delivery_status == 'Order delivered (cash payment)') {
                            			$bgCSS = 'background-color: #008000;';
                            			$hoverCSS = '#008000';
                            		} else if ($ticket->delivery_status == 'Order delivered (card payment)') {
                            			$bgCSS = 'background-color: #008000;';
                            			$hoverCSS = '#008000';
                            		} else if ($ticket->delivery_status == 'Order cancelled') {
                            			$bgCSS = 'background-color: #FF0000;';
                            			$hoverCSS = '#FF0000';
                            		} else {
                            			$bgCSS = '';
                            			$hoverCSS = '';
                            		}
                            	?>
                            	
                            	<!-- <li style="{{ $bgCSS }}"><a onMouseOver="this.style.backgroundColor='{{ $hoverCSS  }}'" href='{{ url("order/$ticket->id/edit") }}'><i class="fa fa-arrow-circle-right"></i> <b>{{ $ticket->id }}</b>: {{ $ticket->delivery_status }}: {{ $ticket->delivery_time }}</a></li> -->
                                <li style="{{ $bgCSS }}" >
                                    <a onMouseOver="this.style.backgroundColor='{{ $hoverCSS  }}'" href='{{ url("order/$ticket->id/edit") }}'><i class="fa fa-shopping-cart"></i> <b>{{ $ticket->id }}</b> 
                                        <span class="pull-right"><i class="fa fa-clock-o"></i> {{ $ticket->delivery_time }}</span>
                                        <p class="text-center" style="margin: 0 0 0px;"> <i class="fa fa-bar-chart"></i> {{ $ticket->delivery_status  }}</p>
                                        <p class="" style="margin: 0 0 0px;"> <i class="fa fa-user"></i> @if(isset($ticket->dbAssigned)) {{ $ticket->dbAssigned->name }} @else <span class="text-red">Doesn't assigned yet</span> @endif <span class="pull-right"><b>৳</b>{{ $ticket->total_price }}</span></p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        {!! $adminTickets->render() !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection