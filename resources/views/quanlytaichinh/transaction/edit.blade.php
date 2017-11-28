@extends('quanlytaichinh.main')
    @section('title')
      Edit Transaction
    @stop
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Edit Transaction
                <small>Edit to your transaction</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="{{ URL::route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#"> Edit transaction</a></li>
                
              </ol>
            </section>
            
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="col-sm-10">
                            
                        </div>
                        <div class="col-sm-1">
                            <a href="{{URL::route('categorys.getList')}}" class="btn btn-app">
                                <i class="fa fa-list"></i> List Transaction 
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        @include('quanlytaichinh.include.alert')
                        <form role="form" action="{{ URL::route('transection.postEdit',$transaction->id)}}" method="post" id="form-add">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="box-body">
                                    
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                             <label for="exampleInputEmail1">Wallets<span class="obligatory">*</span></label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 @if($errors->first('wallets_id')) has-error @endif">
                                            <select name="wallets_id" id="type"   class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                @foreach($wallets as $val)
                                                <option 
                                                @if(old('wallets_id') == $val['id']) 

                                                    selected ="selected" 

                                                @elseif($transaction ->wallets_id == $val['id'] ) 
                                                    selected ="selected" 
                                                @endif
                                                value="{{ $val['id']}}" >{{ $val['name']}}</option>

                                                @endforeach

                                                
                                            </select>
                                            <span class="text-danger"><p>{{ $errors->first('wallets_id') }}</p></span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-0 ">

                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                             <label for="exampleInputEmail1">Type<span class="obligatory">*</span></label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 @if($errors->first('type')) has-error @endif">
                                            <select name="type" id="type-transaction"   class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                <option value=""></option>
                                                <option @if(old('type') == 1 ) selected ="selected" @elseif($transaction ->type == 1) selected ="selected" @endif value="1" >Expenses</option>
                                                <option @if(old('type') == 2 ) selected ="selected" @elseif($transaction ->type == 2) selected ="selected" @endif value="2" >Income</option>
                                            </select>
                                            <span class="text-danger"><p>{{ $errors->first('type') }}</p></span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-0 ">

                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                             <label for="exampleInputEmail1">Categorys<span class="obligatory">*</span></label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 @if($errors->first('category_id')) has-error @endif">
                                            <select name="category_id" id="type-category"   class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                
                                               <option value="{{ $category[0]['id']}}">{{ $category[0]['name']}}</option>
                                               
                                                
                                            </select>
                                            <span class="text-danger"><p>{{ $errors->first('category_id') }}</p></span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-0 ">

                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                            <label for="exampleInputEmail1">Date <span class="obligatory">*</span></label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 @if($errors->first('amount')) has-error @endif">
                                            <input type="date" name="date_now" class="form-control" id="exampleInputAmount" maxlength="18" value="{{date($transaction ->created_at)}}">
                                            <span class="text-danger"><p>{{ $errors->first('amount') }}</p></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                            <label for="exampleInputEmail1">Amount <span class="obligatory">*</span></label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 @if($errors->first('amount')) has-error @endif">
                                            <input type="text" name="amount" class="form-control" id="exampleInputAmount" placeholder="Enter Amount" maxlength="18" value="{{ number_format($transaction ->amount)}}">
                                            <span class="text-danger"><p>{{ $errors->first('amount') }}</p></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                            <label for="exampleInputEmail1">Describe<span class="obligatory">*</span></label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 @if($errors->first('describe')) has-error @endif">
                                            <textarea name="describe" class="form-control" rows="10">{{ $transaction->describe }}</textarea>
                                            <span class="text-danger"><p>{{ $errors->first('describe') }}</p></span>
                                        </div>
                                    </div>


                                    
                                </div>
                              <!-- /.box-body -->

                                <div class="box-footer">
                                    <button id="btn-submit" type="submit" class="btn btn-primary btn-submit">Submit</button>
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
