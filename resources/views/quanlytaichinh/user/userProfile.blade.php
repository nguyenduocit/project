@extends('quanlytaichinh.main')
    @section('title')
      User Profile
    @stop
    @section('content')
<!-- Content Wrapper. Contains page content -->
@if(Auth::check())
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              
              @if(Auth::user()->avata)
                <img class="profile-user-img img-responsive img-circle" src="{{url('public/upload/images')}}/{{ Auth::user()->avata }}" class="img-circle" alt="User profile picture">
              @else
                    <img class="profile-user-img img-responsive img-circle" src="{{url('public/upload/icon/user.jpg')}}" class="img-circle" alt="User profile picture">
              @endif

              <h3 class="profile-username text-center">{{ Auth::user()->name}}</h3>

              <p class="text-muted text-center"></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b> Amount </b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Used</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Remain</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="glyphicon glyphicon-envelope margin-r-5"></i> Email</strong>

                <p class="text-muted">{{ Auth::user()->email}}</p>

                <hr>

                 <strong><i class="glyphicon glyphicon-lock margin-r-5"></i>Password</strong>

                <p class="text-muted">***************</p><a href="" style="font-size: 12px;">Edit Password</a>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i>Adderss</strong>

                <p class="text-muted">{{ Auth::user()->address}}</p>

                <hr>

                <strong><i class="fa fa-phone-square margin-r-5"></i>Phone</strong>

                <p class="text-muted">0{{ Auth::user()->phone}}</p>

                <hr>

                <strong><i class="fa fa-calendar margin-r-5"></i>Birthday</strong>

                <p class="text-muted">{{ Auth::user()->birthday}}</p>

                <hr>

                <strong><i class="fa fa-fw fa-venus-mars margin-r-5"></i>Sex</strong>

                @if(Auth::user()->sex == 1)

                <p class="text-muted">Boy</p>

                @elseif(Auth::user()->sex == 0)

                <p class="text-muted">Girl</p>

                @endif
                    
                <hr>

                {{-- <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> --}}
            </div>
            <!-- /.box-body -->
        </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">

            @include('quanlytaichinh.include.alert')

            <ul class="nav nav-tabs">
              <li class="active" ><a href="#activity" data-toggle="tab" >Edit Profile </a></li>
              
            </ul>
            <div class="tab-content">
                <div class=" active tab-pane" id="settings">
                    
                    <form id="newHotnessForm" action="{{ URL::route('users.postUserProfile')}}" method="post" enctype="multipart/form-data" >

                        <input type="hidden" name="_token" value="{{ csrf_token()}}">

                        <div class="form-group has-feedback  @if($errors->first('name')) has-error @endif">

                            <input type="text" name="name" class="form-control" placeholder="Full name" value="{{ Auth::user()->name}}">
                             <span class="text-danger"><p>{{ $errors->first('name') }}</p></span>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                       
                        <div class="form-group has-feedback">

                            <input type="text" name="address" class="form-control" placeholder="Address" value="{{ Auth::user()->address}}" >
                            <span class="text-danger"><p>{{ $errors->first('address') }}</p></span>
                            <span class="fa fa-road form-control-feedback"></span>
                        </div>

                        <div class="form-group has-feedback">

                            <input type="number" name="phone" class="form-control" placeholder="phone" value="{{ Auth::user()->phone}}" >
                            <span class="text-danger"><p>{{ $errors->first('phone') }}</p></span>
                            <span class="fa fa-phone-square form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">

                            <input type="date" name="birthday" class="form-control" placeholder="birthday" value="{{ Auth::user()->birthday}}">
                            <span class="text-danger"><p>{{ $errors->first('birthday') }}</p></span>
                            <span class="fa fa-calendar form-control-feedback"></span>
                            
                        </div>

                        <div class="form-group has-feedback">

                            <input type="radio" id="" name="sex" class="" checked="" value="1" placeholder = ""> Boy
                            
                            <input type="radio" id="" name="sex" class="" value="0" placeholder = ""> Girl
                        </div>

                        <div class="form-group has-feedback">

                            <input type="file" id="uploadfile" name="Image"  value="" placeholder = "" onchange="readURL(this);"  >
                            <br>
                            <div class="preview" id="thumbbox" >
                                
                                @if(Auth::user()->avata)
                                    <img id="thumbimage"  src="{{url('public/upload/images')}}/{{ Auth::user()->avata }}"  width="15%" alt="Image preview...">
                                    <a class="removeimg" href="javascript:" ></a>
                                @else
                                   
                                    <img id="thumbimage"  src="{{url('public/upload/icon/user.jpg')}}"  width="15%" alt="Image preview...">
                                <a class="removeimg" href="javascript:" ></a>
                                @endif
                            </div>
                            <span class="text-danger"><p>{{ $errors->first('Image') }}</p></span>
                        </div>

                        <div class="row">
                            <!-- <div class="col-xs-8">
                              <div class="checkbox icheck">
                                <label>
                                  <input type="checkbox"> I agree to the <a href="#">terms</a>
                                </label>
                              </div>
                          </div> -->
                          <!-- /.col -->
                          <div class="col-xs-2">
                              <button type="submit" class="btn btn-primary btn-block btn-flat">Edit Profile</button>
                          </div>
                          <!-- /.col -->
                        </div>
                    </form>
                </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @endif
@stop