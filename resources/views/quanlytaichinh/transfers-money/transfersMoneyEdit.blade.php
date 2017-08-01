@extends('quanlytaichinh.main')
    @section('title')
      Edit Transfers Money
    @stop
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Edit Transfers Money
                <small> </small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="{{ URL::route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#"> Information Wallets </a></li>
                
              </ol>
            </section>
            
            <!-- Main content -->
            <section class="content">
                  
                  <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title"></h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                          <i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                        @include('quanlytaichinh.include.alert')
                      <form role="form" action="{{ URL::route('wallets.postEditTransfers',$transfersMoney->id)}}" method="post" id="form-add">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="box-body">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                             <label for="exampleInputEmail1">Transfer wallet</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 @if($errors->first('transfer_wallet')) has-error @endif">
                                          
                                            <select name="transfer_wallet" id="transfer-wallet"  class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                              <option value=""></option>
                                              @foreach($listwallets as $vallets)
                                                    <option value="{{ $vallets->id }}"  @if($transfersMoney->transfer_wallet == $vallets->id) selected="selected" @endif>{{ $vallets->name }}</option>
                                              @endforeach
                                            </select>
                                            <span class="text-danger"><p>{{ $errors->first('transfer_wallet') }}</p></span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-0 ">

                                        </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-3 col-sm-6 col-xs-12 ">
                                        <label for="exampleInputEmail1">Amount Transfer </label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" id="transfer-wallets" readonly="readonly" class="form-control" value="" id="exampleInputAmount" placeholder="Amount Transfer">
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                             <label for="exampleInputEmail1">Receive Wallet</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 @if($errors->first('receive_wallet')) has-error @endif">
                                            <select name="receive_wallet" id="receive-wallet"  class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                              <option value=""></option>
                                              @foreach($listwallets as $vallets)
                                                    <option value="{{ $vallets->id }}" @if($transfersMoney->receive_wallet == $vallets->id) selected="selected" @endif >{{ $vallets->name }}</option>
                                              @endforeach
                                            </select>
                                            <span class="text-danger"><p>{{ $errors->first('receive_wallet') }}</p></span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-0 ">

                                        </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-3 col-sm-6 col-xs-12 ">
                                        <label for="exampleInputEmail1">Amount Receive </label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <input type="text" id="receive-wallets" readonly="readonly"  class="form-control" id="exampleInputAmount" placeholder="Amount Receive">
                                    </div>
                                </div>
                               
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-3 col-sm-6 col-xs-12 ">
                                        <label for="exampleInputEmail1">Amount </label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 @if($errors->first('amount')) has-error @endif">
                                        <input type="text" name="amount" class="form-control" id="exampleInputAmount" placeholder="Enter Amount" value="{{ number_format($transfersMoney->amount) }}">
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

    