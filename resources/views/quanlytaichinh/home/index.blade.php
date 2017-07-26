@extends('quanlytaichinh.main')
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                List Wallets
                <small>Select wallet to view your wallet information</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Wallets</a></li>
                
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                 <!-- Info boxes -->
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box float-right" style="float: right;">
                        <span class="info-box-icon bg-aqua" title="Add wallet"><i class="ion ion-ios-pricetag-outline"></i></span>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3>150$</h3>

                          <p>Name Wallets </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                </div>
                
              <!-- Default box -->
            </section>
            <!-- /.content -->
        </div>
    @stop