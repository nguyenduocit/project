@section('profile')
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

                        <input type="radio" id="" name="sex" class="" checked="" value="1" placeholder = ""> Male
                        
                        <input type="radio" id="" name="sex" class="" value="0" placeholder = ""> Female
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
@stop
