@extends('quanlytaichinh.main')
    @section('title')
      Home Wallets
    @stop
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Money Lover
                <small>Select wallet to view your wallet information</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li></li>
              </ol>
            </section>

            <!-- Main content -->
            
            <section class="content">
                <!-- Default box -->
                <div class="box">
                    <div class="box-body">
                        <div class="box-header">
                          @include('quanlytaichinh.include.alert')
                            <div class="row">
                                <div class="col-sm-7">
                                    <!--  <h3 class="box-title">Responsive Hover Table</h3> -->
                                </div>
                                <div class="col-sm-2">
                                    <div class="box-tools">
                                        <div class="input-group input-group-sm" style="width: 150px; padding-top: 15px;">
                                          <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                          <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <a href="{{ URL::route('wallets.getAdd') }}" class="btn btn-app">
                                        <i class="fa fa-square"></i> Add Wallets 
                                    </a>

                                     <a href="{{ URL::route('wallets.getList') }}" class="btn btn-app">
                                        <i class="fa fa-list"></i> List Wallets 
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            @foreach($listWallets as $val)
                                <div class="col-lg-3 col-xs-6">
                                  <!-- small box -->
                                  <div class="small-box " style="background: {{ $val -> color }};">
                                    <div class="inner">
                                      <h3>{{ number_format($val->amount) }}đ</h3>

                                      <p>{{ $val -> name }}</p>
                                    </div>
                                    <div class="icon">
                                      <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="{{ URL::route('wallets.getInfoWallets', $val->id) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                  </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4 text-center">{!! $listWallets -> links()!!}</div>
                            <div class="col-sm-4"></div>
                            
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box-body -->
                </div>
                  <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
    @stop