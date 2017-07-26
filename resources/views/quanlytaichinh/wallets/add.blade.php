@extends('quanlytaichinh.main')
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Add Wallets
                <small>Add to your wallet</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#"> Add Wallets</a></li>
                
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
              <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ URL::route('wallets.postAdd')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-3 col-sm-6 col-xs-12 ">
                                 <label for="exampleInputEmail1">Name Wallets</label>
                            </div>
                            <div class="col-md-6 col-sm-9 col-xs-12 ">
                            <input type="text" name="name" class="form-control" id="exampleInputWallets" placeholder="Enter Name Wallets">
                            </div>
                        </div><br> <br>
                        
                        <div class="form-group">
                            <div class="col-md-3 col-sm-6 col-xs-12 ">
                                 <label for="exampleInputEmail1">Color</label>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 ">
                            <input type="color" name="colors" class="form-control" id="exampleInputColor" >
                            </div>
                        </div><br> <br>

                        <div class="form-group">
                            <div class="col-md-3 col-sm-6 col-xs-12 ">
                                 <label for="exampleInputEmail1">Amount </label>
                            </div>
                            <div class="col-md-6 col-sm-9 col-xs-12 ">
                            <input type="text" name="amount" class="form-control" id="exampleInputAmount" placeholder="Enter Amount">
                            </div>
                        </div><br> <br>
                      </div>
                      <!-- /.box-body -->

                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                 
                </div>
                <!--/.col (left) -->
              </div>
              <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
    @stop