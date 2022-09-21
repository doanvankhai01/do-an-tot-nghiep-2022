<!DOCTYPE html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <meta name="url" content="{{URL::to('')}}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    {{-- LightSlider --}}
    
    {{-- Boostrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    {{-- Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    {{-- Separate --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/usm/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>       
    <link href="{{asset('public/frontend/css/admin.css')}}" rel="stylesheet">
    {{-- Hiện ngày tháng --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('public/ajax/dashboard/datepicker/datepicker.css')}}">

    {{-- Biểu đồ doanh thu- morris --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<style>
.body-admin{
}
</style>
</head>
<body class="body-admin">
    <div class="admin-header" id="menu-menu-menu">
        <div class="container-fuild" >
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-2 colll2">
                    <button class="btn-info-title" id="btn-info-title-1">
                        <i class="material-icons"id="a-info-icon-top-1">category</i>
                            Sản phẩm
                        (<i id="notification_product"></i>)
                    </button>
                                          
                </div>
                <div class="col-sm-2 colll2">
                    <button class="btn-info-title" id="btn-info-title-2">
                        <i class="material-icons"id="a-info-icon-top-2">list_alt</i>
                            Bình luận mới
                    </button>  
                </div>
                <div class="col-sm-2">
                    <button class="btn-info-title" id="btn-info-title-3">
                        <i class="material-icons"id="a-info-icon-top-4">content_paste</i>
                            Đơn hàng chưa xử lí
                            (<i id="notification_view_order"></i>)
                    </button>  
                </div>
                <div class="col-sm-2 colll2 ">
                    <button class="btn-info-title" id="btn-info-title-4">
                        <i class="material-icons"id="a-info-icon-top-4">content_paste</i>
                            Đơn hàng mới
                            (<i id="notification_new_order"></i>)
                    </button>   
                </div>
                <div class="col-sm-2 colll2">
                    <header class="header-admin" id="admin-profile">   
                        <ul class="nav justify-content-center top-menu">
                            <div class="dropdown">
                                <?php
                                    // $image = Session::get('admin_image');
                                    $image = Auth::user()->admin_image;
                                    if($image){
                                ?>
                                        {{-- <img alt="" src="{{('public/backend/images/2.png')}}"> --}}
                                        <img class="image-admin-profile"id="image-admin-profile" alt="" src="{{('public/uploads/admin/'.$image)}}">
                                <?php
                                    }
                                ?>
                                <span >
                                    <a href="" class="link-href-admin">
                                        <?php
                                            // $name = Session::get('admin_name');
                                            $name = Auth::user()->admin_name;
                                            if($name){
                                                echo $name;
                                            }
                                        ?>
                                    </a>
                                </span>
                                <div class="dropdown-content">
                                    <?php
                                    // $admin_id = Session::get('admin_id');
                                    $admin_id = Auth::id();
                                    ?>
                                    {{-- <li><button class="btn-function-infomation " href="#"><i class=" fa fa-suitcase"></i>Profile</button></li> --}}
                                    <li><button class="btn-function-infomation edit_admin_account_lonely" data-admin_id ="{{$admin_id}}"><i class="fa fa-cog"></i> Chỉnh sửa tài khoản</button></li>
                                    <li>
                                        <form action="{{URL::to('/log-out')}}">
                                            @csrf
                                            <button class="btn-function-infomation"><i class="fa fa-key"></i>Đăng xuất</button>
                                        </form>
                                        <form action="{{URL::to('/log-out-auth')}}">
                                            @csrf
                                            <button class="btn-function-infomation"><i class="fa fa-key"></i>Đăng xuất Auth</button>
                                        </form>
                                    </li>
                                </div>
                            </div>
                        </ul>
                        
                    </header>
                </div>
                <div class="col-sm-"></div>
            </div>
        </div>
        
    </div>
    <div class="container-fuild container-menu-admin">
        <div class="row row-size">
            <div class="col-sm-2">
                <div class="menu-menu-permanent">
                    <div class="logo-background-admin" id="logo-background-admin">
                        <a href="" class="logo">
                            <img class="logo-img" id="logo-img" src="{{URL::to('public/uploads/slider/logo2.png')}}">
                            <b class="logo-b1">TEDDY</b><b class="logo-b2">SHOP</b>
                        </a>
                    </div>
                    <hr>
                    <div class="menu-menu-admin">
                        <div class="scroll-menu">
                            <p class="h5-title-menu"><i class="material-icons">align_vertical_bottom</i> Thống kê</p>
                            <p class="h5-title-menu"><i class="material-icons">content_paste</i></i> Sản Phẩm</p>
                            <form action="{{URL::to('/all-category-product')}}">
                                <p class="p-function-menu-admin"><i class="material-icons">category</i><input class="input-submit-function-menu-admin" type="submit" value="Danh sách danh mục"></p>
                            </form>
                            <form action="{{URL::to('/all-brand-product')}}">
                                <p class="p-function-menu-admin"><i class="material-icons">format_size</i><input class="input-submit-function-menu-admin" type="submit" value="Danh sách nơi sản xuất"></p>
                            </form>
                            <form action="{{URL::to('/all-product')}}">
                                <p class="p-function-menu-admin"><i class="material-icons">list_alt</i><input class="input-submit-function-menu-admin" type="submit" value="Danh sách sản phẩm"></p>
                            </form>

                            <p class="h5-title-menu"><i class="material-icons">shopping_cart</i>Mua Bán</p>
                            <form action="{{URL::to('/manager-order')}}">
                                <p class="p-function-menu-admin"><i class="material-icons">fact_check</i><input class="input-submit-function-menu-admin" type="submit" value="Quản lý đơn hàng"></p>
                            </form>
                            <form action="{{URL::to('/all-coupon')}}">
                                <p class="p-function-menu-admin"><i class="material-icons">list_alt</i><input class="input-submit-function-menu-admin" type="submit" value="Danh sách mã giảm giá"></p>
                            </form>
                            <form action="{{URL::to('/manager-delivery')}}">
                                <p class="p-function-menu-admin"><i class="material-icons">airport_shuttle</i><input class="input-submit-function-menu-admin" type="submit" value="Quản lý Ship hàng"></p>
                            </form>

                            <p class="h5-title-menu"><i class="material-icons">account_tree</i> Quản lý tài khoản</p>
                           
                                <form action="{{URL::to('/all-admin')}}">
                                    <p class="p-function-menu-admin"><i class="material-icons">admin_panel_settings</i><input class="input-submit-function-menu-admin" type="submit" value="Tài khoản quản trị viên"></p>
                                </form>
                       
                            <form action="{{URL::to('/users')}}">
                                <p class="p-function-menu-admin"><i class="material-icons">admin_panel_settings</i><input class="input-submit-function-menu-admin" type="submit" value="Tài khoản Auth"></p>
                            </form>
                       
                            <form action="{{URL::to('/all-customer-account')}}">
                                <p class="p-function-menu-admin"><i class="material-icons">people</i><input class="input-submit-function-menu-admin" type="submit" value="Tài khoản người dùng"></p>
                            </form>

                            <p class="h5-title-menu"><i class="material-icons">devices_other</i> Chuyên mục khác</p>
                            <form action="{{URL::to('/dashboard')}}">
                                <p class="p-function-menu-admin"><i class="material-icons">align_vertical_bottom</i><input class="input-submit-function-menu-admin" type="submit" value="Tổng Quan"></p>
                            </form>
                            <form action="{{URL::to('/manager-slider')}}">
                                <p class="p-function-menu-admin"><i class="material-icons">image</i><input class="input-submit-function-menu-admin" type="submit" value="Quản lý Slider"></p>
                            </form>
                            @hasrole(['insert','delete'])
                                <p class="h5-title-menu"><i class="material-icons">auto_delete</i>Thùng rác</p>
                                <form action="{{URL::to('/waste-basket-product')}}">
                                    <p class="p-function-menu-admin"><i class="material-icons">list_alt</i><input class="input-submit-function-menu-admin" type="submit" value="Sản phẩm"></p>
                                </form>
                                <form action="{{URL::to('/waste-basket-order')}}">
                                    <p class="p-function-menu-admin"><i class="material-icons">fact_check</i><input class="input-submit-function-menu-admin" type="submit" value="Đơn hàng"></p>
                                </form>
                                <form action="{{URL::to('/waste-basket-category')}}">
                                    <p class="p-function-menu-admin"><i class="material-icons">category</i><input class="input-submit-function-menu-admin" type="submit" value="Danh mục"></p>
                                </form>
                                <form action="{{URL::to('/all-waste-basket-slider')}}">
                                    <p class="p-function-menu-admin"><i class="material-icons">image</i><input class="input-submit-function-menu-admin" type="submit" value="Slider"></p>
                                </form>
                                <form action="{{URL::to('/waste-basket-coupon')}}">
                                    <p class="p-function-menu-admin"><i class="material-icons">image</i><input class="input-submit-function-menu-admin" type="submit" value="Mã giảm giá"></p>
                                </form>
                                <form action="{{URL::to('/waste-basket-admin')}}">
                                    <p class="p-function-menu-admin"><i class="material-icons">admin_panel_settings</i><input class="input-submit-function-menu-admin" type="submit" value="Tài khoản quản trị"></p>
                                </form>
                            @endhasrole
                            <form>
                                <img class="img-scroll" id="img-scroll" src="{{URL::to('public/uploads/slider/bamboopanda.png')}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <section class="section-infomation"id="show_edit_admin">
                    @yield('admin_content')
                </section>
                
            </div>
            
            <div class="col-sm-">
            </div>
        </div>
    </div>
    <div class="container-fuild">
        <div class="fooder">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-1">
                    <form action="{{URL::to('/add-slider')}}">
                        <img class="img-fooder" src="{{URL::to('public/uploads/slider/bamboopanda.png')}}">
                    </form>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-sm-1">
                    <form action="{{URL::to('/add-slider')}}">
                        <img class="img-fooder-reverse" src="{{URL::to('public/uploads/slider/bamboopanda.png')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="{{asset('public/frontend/js/jquery/jquery3.6.0.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery/jquery-3.6.0.min.js')}}"></script> --}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <link href="{{asset('public/frontend/css/paginate.css')}}" rel="stylesheet">
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
    {{-- <script src="{{asset('public/frontend/js/jquery.js')}}"></script> --}}
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    {{-- <script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script> --}}
    <script type="text/javascript" src="{{asset('public/backend/js/shopgau-validator.js')}}"></script>
    
    {{-- Giao diện --}}
    <script src="{{asset('public/ajax/dashboard/giaodien/header.js')}}"></script>
    <script src="{{asset('public/ajax/dashboard/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('public/ajax/dashboard/giaodien/notification.js')}}"></script>
    {{-- Hiển thị ngày --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    {{-- <script src="{{asset('public/ajax/dashboard/admin.js')}}"></script> --}}
    {{-- Chức năng ajax --}}
    <section class="section-infomation" id="section-infomation">
        @yield('script')
    </section>
    {{-- <script src="{{asset('public/ajax/dashboard/brand.js')}}"></script> --}}
    {{-- <script src="{{asset('public/ajax/dashboard/category.js')}}"></script> --}}
    {{-- <script src="{{asset('public/ajax/dashboard/filter.js')}}"></script> --}}
    {{-- <script src="{{asset('public/ajax/dashboard/auto_complete.js')}}"></script> --}}
    {{-- <script src="{{asset('public/ajax/dashboard/order.js')}}"></script> --}}
    {{-- <script src="{{asset('public/ajax/dashboard/feeship.js')}}"></script> --}}
    {{-- <script src="{{asset('public/ajax/dashboard/gallery.js')}}"></script> --}}
    {{-- <script src="{{asset('public/ajax/dashboard/statistical.js')}}"></script> --}}
    {{-- <script src="{{asset('public/ajax/dashboard/product.js')}}"></script> --}}

    
    {{-- <script src="{{asset('public/ajax/dashboard/datepicker/datepicker.js')}}"></script> --}}
    {{-- Hiển thị ngày --}}
    {{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}
    
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    {{-- <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script> --}}
    
    <!-- morris JavaScript -->	  

    
</body>
</html>