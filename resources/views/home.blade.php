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

                        <!-- <h3 class="box-title">Select Name List</h3>  -->
                        <!-- <div class="box-tools pull-right">
                            <a href="{{ url('select/create') }}" class="btn btn-primary btn-flat"> <i class="fa fa-plus"></i> Create Select Name</a>
                        </div> -->
                    </div>
                    <?php
                        $textRed = 'text-red';
                    ?>
                    <div class="box-body no-padding">
                        <p class="text-center">Order List of <b>{{ Auth::user()->name }}</b></p>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"><i class="fa fa-circle-o {{ $textRed }}"></i> Important</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-green"></i> Social</a></li>
                        </ul>
                        <hr>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions $tickets = Ticket::with(['ticketDetails'])->where('assigned_id', Auth::id())->orderBy('id', 'desc')->paginate(10);</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                        </ul>

                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-blue"></i> Socialhjkhjk</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-orange"></i> orange <span class="text-orange">test</span></a></li>
                        </ul>

                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                        </ul>

                        <ul class="nav nav-pills nav-stacked">
                            @foreach($tickets as $ticket)
                            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                            @endforeach
                        </ul>
                        {!! $tickets->render() !!}

                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                        </ul>

                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                        </ul>

                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                            <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                        </ul>

                        <!-- <div class="table-responsive"> 
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i = 0;
                                ?>
                                {{-- @foreach($selects as $select) --}}
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ '$select->name' }}</td>
                                        <td>{{ '$select->status' }}</td>
                                        <td>{!! Html::link("select/select->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-success btn-xs btn-flat']) !!}</td>
                                    </tr>
                                {{-- @endforeach --}}
                                </tbody>
                            </table>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('style')
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap.min.css') }}"> -->
@endsection

@section('script')
    <!-- <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script> -->
@endsection