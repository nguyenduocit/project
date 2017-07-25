<!DOCTYPE html>
<html>
<head>
   @include('quanlytaichinh.include.head')
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Forgot Password </b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"></p>

    @include('quanlytaichinh.include.alert')

    <form action="{{ URL::route('users.postForgotPassword') }}" method="post">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group has-feedback">

        <input type="email" name="email" class="form-control" placeholder="Email">

        <span class="text-danger"><p>{!! $errors->first('email') !!}</p></span>

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Send</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <!-- p>- OR -</p> -->
      <!-- <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a> -->
    </div>
    <!-- /.social-auth-links -->

    
    <a href="{{ URL::route('users.getRegister')}}" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

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
