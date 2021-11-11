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
                    </div>
                   
                    <div class="box-body no-padding">
                        
                          <div class="box box-danger">
                              <div class="box-header with-border">
                                  <h3 class="box-title">Order ID Search</h3>
                              </div>
                   
                              <div class="box-footer">
                                  {!! Form::open(['url' => 'search/ticket-id', 'method' => 'get']) !!}
                                      <div class="input-group">
                                          {!! Form::number('ticket_id', null, ['class' => 'form-control', 'placeholder' => 'Enter Order ID', 'autocomplete' => 'off', 'required' => 'required']) !!}
                                          <span class="input-group-btn">
                                              {!! Form::submit('Order ID Search', ['class' => 'btn btn-danger btn-flat']) !!}
                                          </span>
                                      </div>
                                  {!! Form::close() !!}
                              </div>
                          </div>


                          <div class="box box-success">
                              <div class="box-header with-border">
                                  <h3 class="box-title">Date Wise Search</h3>
                              </div>
                   
                              <div class="box-footer">
                                  {!! Form::open(['url' => 'search/date-wise', 'method' => 'get']) !!}
                                      <div class="input-group">
                                          {!! Form::text('created_date', null, ['class' => 'form-control', 'placeholder' => 'Select Date', 'autocomplete' => 'off', 'id' => 'created_date', 'required' => 'required']) !!}
                                          <span class="input-group-btn">
                                              {!! Form::submit('Date Wise Search', ['class' => 'btn btn-success btn-flat']) !!}
                                          </span>
                                      </div>
                                  {!! Form::close() !!}
                              </div>
                          </div>


                           <div class="box box-primary">
                              <div class="box-header with-border">
                                  <h3 class="box-title">Mobile No Search</h3>
                              </div>
                   
                              <div class="box-footer">
                                  {!! Form::open(['url' => 'search/phone-number-wise', 'method' => 'get']) !!}
                                      <div class="input-group">
                                          {!! Form::number('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Mobile No', 'autocomplete' => 'off', 'required' => 'required']) !!}
                                          <span class="input-group-btn">
                                              {!! Form::submit('Mobile No. Search', ['class' => 'btn btn-primary btn-flat']) !!}
                                          </span>
                                      </div>
                                  {!! Form::close() !!}
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
@endsection

@section('script')
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript">
        $('#created_date').datepicker({
            format:'yyyy-mm-dd',
            "autoclose": true
        }).datepicker("setDate",'now');
    </script>
@endsection