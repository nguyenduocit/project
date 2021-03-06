<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="{{url('public/upload/icon/iconlogo.png')}}" type="image/x-icon"/>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ url('public/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('public/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('public/dist/css/skins/_all-skins.min.css') }}">

 <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('public/plugins/iCheck/square/blue.css') }}">
  <!--bootstrap-multiselect-->
  <link rel="stylesheet" href="{{ url('public/style/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('public/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}">

  <?php $link =  url('/');?>
<script >
  var link = '{{ $link }}'+'/';
</script>
<!-- jQuery 2.2.0 -->
<script src="{{ url('public/plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ url('public/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ url('public/plugins/chartjs/Chart.min.js') }}"></script>

  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  