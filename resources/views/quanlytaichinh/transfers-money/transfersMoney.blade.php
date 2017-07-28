@extends('quanlytaichinh.main')
    @section('title')
      Transfers Money
    @stop
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Transfers Money
                <small> </small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="{{ URL::route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#"> Information Wallets </a></li>
                
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
                                    <div class="col-sm-7">
                                        <h3 class="box-title"></h3>
                                    </div>
                                    
                                </div>
                            </div>

                            <!-- /.box-header -->
                            <form role="form" action="{{ URL::route('wallets.postTransfersMoney')}}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="box-body">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                             <label for="exampleInputEmail1">Transfer wallet</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                                          
                                            <select name="transfer-wallet"  class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                              <option value=""></option>
                                              @foreach($listwallets as $vallets)
                                                    <option value="{{ $vallets->id }}">{{ $vallets->name }}</option>
                                              @endforeach
                                            </select>
                                            <span class="text-danger"><p>{{ $errors->first('transfer-wallet') }}</p></span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-0 ">

                                        </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                             <label for="exampleInputEmail1">Receive Wallet</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                                            <select name="receive-Wallet"  class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                              <option value=""></option>
                                              @foreach($listwallets as $vallets)
                                                    <option value="{{ $vallets->id }}">{{ $vallets->name }}</option>
                                              @endforeach
                                            </select>
                                            <span class="text-danger"><p>{{ $errors->first('receive-Wallet') }}</p></span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-0 ">

                                        </div>
                                </div>
                               
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-3 col-sm-6 col-xs-12 ">
                                        <label for="exampleInputEmail1">Amount </label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" name="amount" class="form-control" id="exampleInputAmount" placeholder="Enter Amount" value="{{ old('amount')}}">
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

    