<!DOCTYPE html>
@section('title')
  Register
@stop
<html>
<head>
  @include('quanlytaichinh.include.head')
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Register</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="{{ URL::route('users.postRegister')}}" method="post" enctype="multipart/form-data" >

        <input type="hidden" name="_token" value="{{ csrf_token()}}">

        <div class="form-group has-feedback @if($errors->first('name')) has-error @endif">

            <input type="text" name="name" class="form-control" placeholder="Full name" value="{{ old('name')}}">
             <span class="text-danger"><p>{{ $errors->first('name') }}</p></span>
            <span class="glyphicon glyphicon-user form-control-feedback" style="color: red;"></span>
        </div>
        <div class="form-group has-feedback @if($errors->first('email')) has-error @endif">

            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email')}}" >

            <span class="text-danger"><p>{{ $errors->first('email') }}</p></span>
            <span class="glyphicon glyphicon-envelope form-control-feedback" style="color: red;" ></span>

        </div>
        <div class="form-group has-feedback @if($errors->first('password')) has-error @endif">

            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="text-danger"><p>{{ $errors->first('password') }}</p></span>
            <span class="glyphicon glyphicon-lock form-control-feedback" style="color: red;" ></span>

        </div>
        <div class="form-group has-feedback @if($errors->first('rpassword')) has-error @endif">

            <input type="password" name="rpassword" class="form-control" placeholder="Retype password">
            <span class="text-danger"><p>{{ $errors->first('rpassword') }}</p></span>
            <span class="glyphicon glyphicon-log-in form-control-feedback" style="color: red;"></span>
        </div>
        <div class="form-group has-feedback">

            <input type="text" name="address" class="form-control" placeholder="Address" value="{{ old('address')}}" >
            <span class="fa fa-road form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">

            <input type="number" name="phone" class="form-control" placeholder="phone" value="{{ old('phone')}}" >
            <span class="fa fa-phone-square form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">

            <input type="date" name="birthday" class="form-control" placeholder="birthday" value="{{ old('birthday')}}">
            
            <span class="fa fa-calendar form-control-feedback"></span>
            
        </div>

        <div class="form-group has-feedback">

            <input type="radio" id="" name="sex" class="" checked="" value="1" placeholder = "">Male
            
            <input type="radio" id="" name="sex" class="" value="0" placeholder = "">Female
        </div>

        <div class="form-group has-feedback">

            <input type="file" id="uploadfile" name="Image"  value="" placeholder = "" onchange="readURL(this);" >
              <div class="preview showimg" id="thumbbox" >
                  <img id="thumbimage"  src=""  width="30%" alt="Image preview...">
                  <a class="removeimg" href="javascript:" ></a>
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
          <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
          </div>
          <!-- /.col -->
        </div>
    </form>

   <!--  <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div> -->

    <a href="{{ URL::route('users.getLogin')}}" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.0 -->

@include('quanlytaichinh.include.java')
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
