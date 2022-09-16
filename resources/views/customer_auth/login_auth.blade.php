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
    <div class="row">
        <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="h2-title">Đăng nhập tài khoản quản trị</h2>
                    </header>
                     <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>
                       
                    
                                <form action="{{url('/login-at-auth')}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @foreach($errors->all() as $val)
                                        <ul>
                                            <li>{{$val}}</li>
                                        </ul>
                                    @endforeach
                                    {{-- old('admin_name'): là khi có lỗi thì hiển thị thông báo nhưng vẫn giữ lại nội dung đã nhập
                                    
                                    --}}
                                    
                                    
                                    <label class="lable-title">EmailL</label>
                                    <input type="text" name="admin_email" class="form-control admin_email" value="{{old('admin_email')}}" id="admin_email" placeholder="Example@gmail.com">
                                
                                    <label class="lable-title">Mật khẩu</label>
                                    <input type="text" name="admin_password" class="form-control admin_password" value="{{old('admin_password')}}" id="admin_password" placeholder="......">
                                
                                    
                                 
                                    
                                    <input type="submit" name="login" class="btn-submit-function" onmousemove="" value="Đăng nhập">
                                </form>
                     
                </section>

        </div>
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