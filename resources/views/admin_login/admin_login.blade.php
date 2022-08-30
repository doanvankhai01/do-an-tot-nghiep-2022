<!DOCTYPE html>
<head>
<title>Trang quản lý Admin Web</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
{{-- <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script> --}}
<link href="{{asset('public/frontend/css/login_admin.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
<style>
  .body{
    background-image: url("{{URL::to('public/uploads/slider/131170.jpg')}}");
    background-size: 100% 165%;

}
</style>
</head>
<!-- onmouseout:	Xảy ra khi con trỏ chuột bắt đầu rời khỏi phần tử HTML// Lưu ý: -->
<!-- onkeyup:	Xảy ra khi bạn gõ phím nhưng lúc bạn bỏ phím ra sẽ được kích hoạt -->
<!-- onkeydown:	Xảy ra khi gõ một phím bất kì vào ô input -->
<!-- onclick	Xảy ra khi click vào phần tử HTML
ondbclick:	Xảy ra khi double click vào phần tử HTML -->
<!-- onmouseout:	Xảy ra khi con trỏ chuột bắt đầu rời khỏi phần tử HTML -->
<body class="body">
        <div class="login-admin">
            <span class="span">
                <form class="form-login-admin" id="form_login_admin"name="login" action="{{URL::to('/admin-dashboard')}}" method="post">
                    <h2 class="h2-login">Đăng nhập!</h2>
                    <?php
                    $message = Session::get("message");
                    if($message){
                        echo '<script type="text/javascript">window.setTimeout(function test(){'.$message.'},100);</script>';
		                Session::put('message',null);
                    ?>
                    <?php
                    }
                    ?>
                    <br>
                    {{ csrf_field() }} <!--Mã hóa thông tin để tăng khả năng bảo mật-->
                    <b text-align ="center"id="error_login_logout"></b>
                    <input id="email_login_admin" type="text"  class="input-login-email-password" name="email" placeholder="Điền email" onkeyup="validation_login();">
                    <b class="error-function" id="email_error_admin"></b>
                    <input id="password_login_admin" type="password" class="input-login-email-password" name="password" placeholder="Điền password" onkeyup="validation_login();">
                    <b class="error-function" id="password_error_admin"></b>
                    <div class="clearfix"></div>
                    <input class="btn-login-function" type="submit" id="" value="Đăng nhập" name="login" >
                </form>
            </span>
        </div>
</body>
{{-- <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script> --}}
<link href="{{asset('public/frontend/css/paginate_login.css')}}" rel="stylesheet">
<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/backend/js/shopgau-validator.js')}}"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
{{-- <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script> --}}
</body>
</html>
