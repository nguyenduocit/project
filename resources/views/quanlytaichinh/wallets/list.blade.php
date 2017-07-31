@extends('quanlytaichinh.main')
    @section('title')
      List Wallets
    @stop
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                List Wallets
                <small>List your wallet</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="{{ URL::route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#"> List Wallets</a></li>
                
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
              <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-sm-7">     
                            </div>
                            <div class="col-sm-2">
                           {{--<div class="box-tools">
                                    <div class="input-group input-group-sm" style="width: 150px; padding-top: 15px;">
                                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>    
                         </div>
                           

                     </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('quanlytaichinh.include.alert')
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_length" id="example1_length" style="padding-top: 15px;">
                                        <label>
                                            Show 
                                            <select name="example1_length" aria-controls="example1" class="form-control input-sm" id="number-list-wallets">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                            </select>
                                            entries
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    
                                    <div style="padding-top: 15px;" id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" id="search" aria-controls="example1"></label></div>
                                    
                                   {{--  <div class="col-sm-6">
                                        <label>
                                            Arrange
                                            <select name="example1_length" aria-controls="example1" class="form-control input-sm" id="arrange-list-wallets">
                                                <option value=""></option>
                                                <option value="az">Sorted by name A -> Z</option>
                                                <option value="za">Sorted by name Z -> A</option>
                                                <option value="high-to-low">Sorted by amount high to low</option>
                                                <option value="low-to-high">Sorted by amount  low to high</option>
                                            </select>
                                        </label>
                                    </div> --}}

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
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending" style="width: 100px;"><input type="checkbox" name="" class="checkall" ></th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 100px;" >STT</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 307px;">Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 244px;">Color</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 181px;">Amount</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 181px;">Created at</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 181px;">Updated at</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 181px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-wallets">
                                        <?php $stt = 0 ;?>
                                            @foreach($listWallets as $val)
                                                <tr class="row_{{ $val->id }} select" >
                                                    <td class="sorting_1"><input type="checkbox" name="id[]" value="{{ $val->id }}"> </td>
                                                    <td> {{ $stt = $stt +1 }}</td>
                                                    <td> {{ $val->name }} </td>
                                                    <td><input type="color" name="" value="{{ $val->color }}"></td>
                                                    <td> {{ number_format($val->amount) }}</td>
                                                    <td> {{ $val ->created_at}}</td>
                                                    <td>{{ $val->updated_at}}</td>
                                                    <td>
                                                        <a href="{{URL::route('wallets.getEdit',$val->id)}}"  title="Edit" class=""><i class="fa fa-fw fa-edit"></i></a>
                                                        <a   title="Delete" class="delete" id="{{ $val->id}}" name="{{ $val->name }}"><i class="fa fa-fw fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    {{-- <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 57 of 57 entries</div> --}}

                                    <div class="delete-all-wallets itemActions">
                                        <a url="" class="button blueB" id="submit" href="#submit">
                                            <span class="btn btn-primary" style="color:white;">Delete All</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        {!! $listWallets -> links()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                 
                </div>
                <!--/.col (left) -->
              </div>
              <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
    @stop