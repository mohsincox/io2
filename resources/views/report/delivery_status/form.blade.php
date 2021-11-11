@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content" style="padding-left: 0px; padding-right: 0px;">
        <div class="row">
        	<div class="col-md-8 col-sm-offset-2">
            	<div class="box box-success">
                	<!-- <div class="box-header with-border">
                    	<h3 class="box-title">Delivery Status Wise Ticket Report Form</h3> 
                	</div> -->
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
                        <!-- <div class="box-tools pull-right">
                            <button onClick="window.location.reload();" class="btn btn-info btn-flat"> <i class="fa fa-refresh"></i></button>
                        </div> -->
                    </div>
                	<div class="box-body">

                		<div class="col-sm-12">
    						
    						<div class="card">
    							<div class="card-header" style="margin-bottom: 30px;">
    								<p class="text-center"><i class="fa fa-chart-bar"></i> <code><b>Delivery Status Wise</b></code> Order Form</p>
    							</div>
    							<div class="card-body">
    						  		
    								
                                    {!! Form::open(['url' => 'report/delivery-status-show', 'method' => 'get', 'class' => 'form-horizontal']) !!}

                                    <div class="form-group {{ $errors->has('delivery_status') ? 'has-error' : ''}}">
                                        {!! Form::label('delivery_status', 'Delivery Status', ['class' => 'col-sm-3 col-xs-12 control-label required']) !!}
                                        <div class="col-xs-12 col-sm-9">
                                           {!! Form::select('delivery_status', ['Order confirmed' => 'Order confirmed', 'Order collected from depot' => 'Order collected from depot', 'On the way for order deliver' => 'On the way for order deliver', 'Order delivered (cash payment)' => 'Order delivered (cash payment)', 'Order delivered (card payment)' => 'Order delivered (card payment)', 'Order cancelled' => 'Order cancelled'], null, ['class' => 'form-control select2', 'placeholder' => 'Select Delivery Status', 'required' => 'required']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('delivery_status') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
                                        {!! Form::label('start_date', 'Date', ['class' => 'required col-sm-3 col-xs-12 control-label']) !!}
                                        <div class="col-xs-12 col-sm-9">
                                            {!! Form::text('start_date', null, ['class' => 'form-control', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'id' => 'start_date', 'readonly' => 'readonly', 'required' => 'required']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('start_date') }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
                                        {!! Form::label('end_date', 'End Date', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::text('end_date', null, ['class' => 'form-control', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'id' => 'end_date', 'readonly' => 'readonly', 'required' => 'required']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('end_date') }}
                                            </span>
                                        </div>
                                    </div> -->

                                    <div class="box-footer">
                                        
                                        <!-- <a href="{{ url('/profile') }}" class="btn btn-default">Cancel</a> -->
                                        
                                        {!! Form::submit('Submit', ['class' => 'btn btn-block btn-success pull-right']) !!}
                              
                                    </div>
                                    {!! Form::close() !!}

    							</div>
    						</div>
    					</div>

                	</div>
          		</div>
        	</div>
      	</div>
    </section>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
@endsection

@section('script')
	<script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript">
    	 $(function () {
            $('.select2').select2()
        })

        $('#start_date').datepicker({
            format:'yyyy-mm-dd',
            "autoclose": true
        }).datepicker("setDate",'now');

        // $('#end_date').datepicker({
        //     format:'yyyy-mm-dd',
        //     "autoclose": true
        // }).datepicker("setDate",'now');
    </script>
@endsection