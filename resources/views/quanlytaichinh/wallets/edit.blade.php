@extends('quanlytaichinh.main')
    @section('title')
      Edit Wallets
    @stop
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
             <section class="content-header">
              <h1>
                Edit Wallets
                <small>Edit to your wallet</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="{{ URL::route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#"> Edit Wallets</a></li>
                
              </ol>
            </section>
            
            <!-- Main content -->
             <section class="content">

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-xs-12">
                          <div class="box">
                            <div class="box-header">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h3 class="box-title"></h3>
                                    </div>
                                    <div class="col-sm-2">
                                       {{--  <div class="box-tools">
                                            <div class="input-group input-group-sm" style="width: 150px; padding-top: 15px;">
                                              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                              <div class="input-group-btn">
                                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                              </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="col-sm-2">
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
                           <form role="form" action="{{ URL::route('wallets.postEdit',$wallets -> id)}}" method="post">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                  <div class="col-md-3 col-sm-6 col-xs-12 ">
                                       <label for="exampleInputEmail1">Name Wallets</label>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12 ">
                                      <input type="text" name="name" class="form-control" id="exampleInputWallets" placeholder="Enter Name Wallets" value="{{ $wallets -> name}}">
                                      <span class="text-danger"><p>{{ $errors->first('name') }}</p></span>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-xs-0 ">

                                  </div>
                              </div>
                              
                              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                  <div class="col-md-3 col-sm-6 col-xs-12 ">
                                       <label for="exampleInputEmail1">Color</label>
                                  </div>
                                  <div class="col-md-1 col-sm-2 col-xs-4 ">
                                      <input type="color" name="colors" class="form-control" id="exampleInputColor" value="{{ $wallets -> color}}">
                                      
                                  </div>


                              </div>

                              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                  <div class="col-md-3 col-sm-6 col-xs-12 ">
                                      <label for="exampleInputEmail1">Amount </label>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12 ">
                                      <input type="text" name="amount" class="form-control" id="exampleInputAmount" placeholder="Enter Amount" value="{{ $wallets -> amount}}" >
                                      <span class="text-danger"><p>{{ $errors->first('amount') }}</p></span>
                                  </div>
                              </div><br> <br>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </form>
                              <!-- /.box-body -->
                        </div>
                      <!-- /.box -->
                    </div>
                </div>
                <!-- ./col -->
              <!-- Default box -->
            </section>
            <!-- /.content -->
        </div>
    @stop

