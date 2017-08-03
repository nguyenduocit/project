@extends('quanlytaichinh.main')
    @section('title')
      Edit Categorys
    @stop
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Edit Categorys
                <small>Edit to your categorys</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="{{ URL::route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#"> Edit Categorys</a></li>
                
              </ol>
            </section>
            
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="col-sm-9">
                            
                        </div>
                        <div class="col-sm-3">
                            <a href="{{URL::route('categorys.getAdd')}}" class="btn btn-app">
                                <i class="fa fa-square"></i> Add Category 
                            </a>
                            <a href="{{URL::route('categorys.getList')}}" class="btn btn-app">
                                <i class="fa fa-list"></i> List Category 
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        
                        @include('quanlytaichinh.include.alert')
                        <form role="form" action="{{ URL::route('categorys.postEdit',$category[0]->id)}}" method="post" id="form-add">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="box-body">

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                             <label for="exampleInputEmail1">Type</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            @if($category[0]->type == 1)
                                                <p>Expenses</p>
                                            @elseif($category[0]->type == 2)
                                                <p>Income</p>
                                            @endif
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-0 ">

                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                                            <div class="col-md-3 col-sm-6 col-xs-12 ">
                                                 <label for="exampleInputEmail1">Name Categorys<span class="obligatory">*</span></label>
                                            </div>
                                            <div class=" form-group  col-md-6 col-sm-6 col-xs-12 @if($errors->first('name')) has-error @endif">
                                                <input type="text" name="name" class="form-control" id="exampleInputWallets" placeholder="Enter Name Categorys" maxlength="255"  value="{{ $category[0] ->name }}">
                                                <span class="text-danger"><p>{{ $errors->first('name') }}</p></span>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-0 ">

                                            </div>
                                    </div>

                                    
                                   {{--  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-3 col-sm-6 col-xs-12 ">
                                             <label for="exampleInputEmail1">Category Parent</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 @if($errors->first('parent_id')) has-error @endif">
                                            <select name="parent_id" id="parent_id"  class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                <option value=""></option>
                                                @foreach($parent as $val)
                                                    <option 
                                                    @if(old('parent_id') == $val['id'] ) 
                                                    selected ="selected" 
                                                    @elseif($category[0]->parent_id == $val['id'] )
                                                    selected ="selected"
                                                    @endif
                                                    
                                                    value="{{ $val['id']}}">{{ $val['name']}}</option>
                                                @endforeach
                                               
                                            </select>
                                            <span class="text-danger"><p>{{ $errors->first('parent_id') }}</p></span>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-0 ">

                                        </div>
                                    </div> --}}
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
