@extends('quanlytaichinh.main')
    @section('title')
     Transaction list
    @stop
    @section('content')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
               Transaction list
                <small>Transaction list of wallets</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="{{ URL::route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
               <li><a href="#"> Information Wallets </a></li>
              </ol>
            </section>

            <!-- Main content -->
            
            <section class="content">
                <!-- Default box -->
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
                        <div class="box-header">
                          @include('quanlytaichinh.include.alert')
                        </div>
                        <!-- /.box-header -->
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="dataTables_length" id="example1_length" style="padding-top: 15px;">
                                        <label>
                                            Show 
                                            <select name="example1_length" aria-controls="example1" class="form-control input-sm" id="number-list-transfers">
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
                                    
                                   {{--  <div style="padding-top: 15px;" id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" id="search-transaction" aria-controls="example1"></label></div> --}}
                                    
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
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                {{-- <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending" style="width: 100px;"><input type="checkbox" name="" class="checkall" ></th> --}}
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 100px;" >STT</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 307px;">Transfer Wallet</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 244px;">Receive Wallet</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 181px;">Amount</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 181px;">Created at</th>
                                                {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 181px;">Updated at</th> --}}
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 181px;">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tbody-wallets">
                                            <?php $stt = 0 ;?>
                                                @foreach($transfersMoney as $val)
                                                    <tr class="row_{{ $val->id }} select" >
                                                        
                                                        <td> {{ $stt = $stt +1 }}</td>
                                                        <td> {{ $val->name_transfer_wallet}} </td>
                                                        <td> {{ $val->name_receive_wallet }}</td>
                                                        <td> {{ number_format($val->amount) }}đ</td>
                                                        <td> 
                                                            <?php echo \Carbon\Carbon::createFromTimestamp(strtotime($val ->created_at))->diffForHumans(); ?>
                                                        </td>
                                                       {{--  <td> {{ $val->updated_at}}</td> --}}
                                                        <td>
                                                            <a href="{{URL::route('wallets.getEditTransfers',$val->id)}}"  title="Edit" class=""><i class="fa fa-fw fa-edit"></i></a>
                                                            <a   title="Delete" class="delete-transfers" id="{{ $val->id}}"><i  class="fa fa-fw fa-trash-o"></i></a>
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

                                    {{-- <div class="delete-all-transaction itemActions">
                                        <a url="" class="button blueB" id="submit" href="#submit">
                                            <span class="btn btn-primary" style="color:white;">Delete All</span>
                                        </a>
                                    </div> --}}
                                </div>
                                <div class="col-sm-7">
                                    
                                        {!! $transfersMoney -> links()!!}
                                </div>
                            </div>
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