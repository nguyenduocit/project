@extends('quanlytaichinh.main')
    @section('title')
      Add Wallets
    @stop
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Add Wallets
                <small>Add to your wallet</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="{{ URL::route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#"> Add Wallets</a></li>
                
              </ol>
            </section>
            
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="col-sm-10">
                            
                        </div>
                        <div class="col-sm-1">
                            <a href="{{ URL::route('wallets.getList') }}" class="btn btn-app">
                                <i class="fa fa-list"></i> List Wallets 
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        @include('quanlytaichinh.include.alert')
                        <form role="form" action="{{ URL::route('wallets.postAdd')}}" method="post" id="form-add">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="box-body">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                             <label for="exampleInputEmail1">Name Wallets</label>
                                        </div>
                                        <div class=" form-group  col-md-6 col-sm-6 col-xs-12 @if($errors->first('name')) has-error @endif">
                                            <input type="text" name="name" class="form-control" id="exampleInputWallets" placeholder="Enter Name Wallets" value="{{ old('name')}}">
                                            <span class="text-danger"><p>{{ $errors->first('name') }}</p></span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-0 ">

                                        </div>
                                </div>
                                    
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                             <label for="exampleInputEmail1">Color</label>
                                        </div>
                                        <div class="col-md-1 col-sm-2 col-xs-12 ">
                                            <input type="color" name="colors" class="form-control" id="exampleInputColor" value="{{ old('colors')}}">
                                            
                                        </div>


                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-3 col-sm-6 col-xs-12 ">
                                        <label for="exampleInputEmail1">Amount </label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 @if($errors->first('amount')) has-error @endif">
                                        <input type="text" name="amount" class="form-control" id="exampleInputAmount" placeholder="Enter Amount" value="{{ old('amount')}}">
                                        <span class="text-danger"><p>{{ $errors->first('amount') }}</p></span>
                                    </div>
                                </div><br> <br>
                                </div>
                              <!-- /.box-body -->

                                <div class="box-footer">
                                    <button id="btn-submit" type="button" class="btn btn-primary btn-submit">Submit</button>
                                </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                  <!-- /.box -->
            </section>
            
            <!-- /.content -->
        </div>
    @stop
