<!DOCTYPE html>
<html lang="en">
<head>
    <!----------SEO----------->
    <meta charset="utf-8">
    <title>{{$meta_title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <meta name="author" content=""/>
    <link rel="canonical" href="{{$url_canonical}}"/>
    <!----------//SEO----------->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('public/frontend/css/home.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    {{-- Boostrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     
    
    <link rel="shortcut icon" href="{{('public/frontend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <link href="{{asset('public/frontend/css/paginate_page.css')}}" rel="stylesheet">
    {{-- lightslider --}}
    <link href="{{asset('public/lightslider/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/lightslider/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/lightslider/css/prettify.css')}}" rel="stylesheet">

    {{-- end lightslider --}}
    {{--  --}}
</head><!--/head-->
<body class="body-homepage">
    <?php
        // echo Session::get('customer_id');
        // echo Session::get('shipping_id');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="logo-background-admin" id="logo-background-admin">
                    <a class="a-logo" href="{{URL::to('/trang-chu')}}">
                        <img class="logo-img" id="logo-img" src="{{URL::to('public/uploads/slider/logo2.png')}}">
                        <b class="logo-b1">TEDDY</b><b class="logo-b2">SHOP</b>
                    </a>
                </div>
                <div class="title-image-home">
                    <p class="p-advertisement">TEDDY SHOP</p>
                    <span class="span-title-advertisement">
                        <p class="p-advertisement-2">BỞI BẠN KHÔNG THỂ CHÌM VÀO GIÁC NGỦ NẾU KHÔNG CÓ EM NÓ BÊN CẠNH</p>
                        <p class="p-advertisement-2">EM NÓ VẪN LUÔN LÀ CHÚ GẤU BÔNG MÀ BẠN YÊU THƯƠNG NHẤT.VỚI BẠN, KHÔNG AI ÔM GIỎI HƠN EM NÓ</p>
                        <P class="p-advertisement-2">CÙNG NHAU TRẢI NGHIỆM MỌI THỨ, ĐẶC BIỆT LÀ CHIẾC GIƯỜNG MỚI TẬU</P>
                    </span>
                    <span class="span-title-advertisement">
                        <p class="p-advertisement-3"></p>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <section id="slider"><!--slider-->
        <div class="container-fuild">
            <div class="row-sm">
                <div class="col-sm-12">
                    <div id="demo" class="carousel slide" data-bs-ride="carousel">
                        <!-- Indicators/dots -->
                        <div class="carousel-indicators">
                            @php 
                            $a = -1;
                            @endphp
                            @foreach($all_slider as $key => $slid)
                                @php 
                                    $a++;
                                @endphp
                                <button type="button" data-bs-target="#demo" data-bs-slide-to="{{$a}}" class="{{$a==0 ? 'active' : '' }}"></button>
                            @endforeach
                        </div>   
                        <!-- The slideshow/carousel -->
                        <div class="carousel-inner">
                            @php 
                            $i = 0;
                            @endphp
                            @foreach($all_slider as $key => $slid)
                                @php 
                                    $i++;
                                @endphp
                                <div class="carousel-item {{$i==1 ? 'active' : '' }}">
                                    <img class="banner-slider-img" alt="{{$slid->slider_desc}}" src="{{asset('public/uploads/slider/'.$slid->slider_image)}}"class="d-block w-100">
                                </div>
                            @endforeach
                        </div>
                        <!-- Left and right controls/icons -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/slider-->
    <header id="header"><!--header-->
        <div class="header-middle"><!--header-middle-->
            <div class="container-fuild">
                <div class="row class-menu-menu" id="class-menu-menu">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-1">
                        <img class="logo-img-2" id="logo-img" src="{{URL::to('public/uploads/slider/logo2.png')}}">
                        <b class="logo-b1-2">TEDDY</b><b class="logo-b2-2">SHOP</b>
                    </div>
                    <div class="col-sm-6">
                        <ul class="ul-dropdown">
                            <li class="li-dropdown"><a class="a-class-menu" href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                            <li class="li-dropdown"><a class="a-class-menu" href="{{URL::to('/trang-chu')}}">Tin tức</a></li>

                            <li class="li-dropdown dropdown">
                                <a class="a-class-menu dropbtn">Danh mục</a>
                                <div class="dropdown-content">
                                    @foreach($category as $key => $cate)
                                        <a class="dropdown-menu-menu-item" href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a>
                                    @endforeach
                                </div>
                            </li>

                            <li class="li-dropdown"><a class="a-class-menu" href="{{URL::to('/login-checkout')}}"><i class="fa fa-star"></i> Yêu thích</a></li>
                            <?php
                                $customer_id = Session::get('customer_id');
                                $shipping_id = Session::get('shipping_id');
                                if($customer_id!=NULL && $shipping_id==NULL){
                            ?>
                            <li class="li-dropdown"><a class="a-class-menu" href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            <?php
                                }elseif($customer_id!=NULL && $shipping_id!=NULL){
                            ?>
                            <li class="li-dropdown"><a class="a-class-menu" href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            <?php 
                            }else{
                            ?>
                            <li class="li-dropdown"><a class="a-class-menu" href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            <?php
                            }
                            ?>
                            <li class="li-dropdown"><a class="a-class-menu" href="{{URL::to('/show-cart-ajax')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                            <?php
                            $customer_id = Session::get('customer_id');
                            if($customer_id!=NULL){ 
                            ?>
                            <li class="li-dropdown"><a class="a-class-menu" href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                            <?php
                            }else{
                            ?>
                            <li class="li-dropdown"><a class="a-class-menu" href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                            <?php 
                            }
                            ?>
                        </ul>     
                    </div>
                    <div class="col-sm-3">
                        <form action="{{URL::to('/tim-kiem-theo-ten-san-pham-tren-page')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{URL::to('')}}" name="url" id="url" class="form-control url" placeholder="url">
                            <div class="search_box pull-right">
                                <input class="search-all-product" type="text" name="keywords_submit" id="keywords" placeholder="Tìm kiếm sản phẩm"/>
                                <input class="button-search-home"type="submit" name="search_items" value="Tìm kiếm">
                            </div>
                            <div class="div-auto-complete-search" style="" id="search_ajax"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        {{-- <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
                                       
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                               
                                </li> 
                                <li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a></li>
                                <li><a href="contact-us.html">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{URL::to('/tim-kiem-theo-ten-san-pham-tren-page')}}" method="POST">
                            {{csrf_field()}}
                        <div class="search_box pull-right">
                            <input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm"/>
                            <input type="submit" style="margin-top:0;color:#666" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom--> --}}
    </header><!--/header-->
    <div class="col-sm-3">
        <div class="left-sidebar">
        
            {{-- <div class="brands_products">
                <h2>Thương hiệu sản phẩm</h2>
                <div class="brands-name">
                    <ul class="nav nav-pills nav-stacked">
                        @foreach($brand as $key => $brand)
                        <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}"> <span class="pull-right">(50)</span>{{$brand->brand_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div> --}}
        </div>
    </div>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   @yield('content')
                </div>
            </div>
        </div>
    </section>
    <br>
    <footer class="footer_page"><!--Footer-->
        <div class="container">
            <div class="row">
                
                <div class="col-sm-3 coll-footer">
                    <h2 class="title-footer">Liên hệ</h2>
                    <p class="p-footer"><b class="logo-b1">TEDDY</b><b class="logo-b2">SHOP</b> </p>
                    <p class="p-footer">Số điện thoại: (+81) 378726127</p>
                    <p class="p-footer">Email: khaidoan0110@gmail.com</p>
                    <p class="p-footer">Địa chỉ: 176 Trần Phú, phường Phước Vĩnh, thành phố Huế</p>
                    <p class="p-footer"></p>

                </div>
                <div class="col-sm-3 coll-footer">
                    <h2 class="title-footer">Danh mục</h2>
                    @foreach($category as $key => $cate)
                        <p class="p-footer"><a class="a-footer" href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></p>
                    @endforeach
                </div>
                <div class="col-sm-3 coll-footer">
                    <h2 class="title-footer">Giỏ hàng</h2>
                    @if(Session::get('cart')==true)
							<table class="table table-condensed border-danger">
								<tbody>
									<?php
										$total = 0;
									?>
									@foreach(Session::get('cart') as $key => $cart)
									<tr class="td-show-cart">
										<td class="cart_product ">
											<a href=""><img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="40px" alt="{{$cart['product_name']}}" /></a>
										</td>
										<td class="cart_description down-the-line-name">
											<h4><a href=""></a></h4>
											<p class="">{{$cart['product_name']}}</p>
										</td>
										<td class="cart_price">
											<p>{{number_format($cart['product_price'],0,',','.')}} VNĐ</p>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<span class="center">
								<?php
									echo'<h5>Giỏ hàng trống !<i class="fa fa-shopping-cart"></i></h5>';
								?>
							</span>
						@endif
                </div>
                <div class="col-sm-3">
                    <h2 class="title-footer">Sản phẩm mới nhất</h2>
                    @foreach($all_product as $key => $foot_pro)
                        <p class="p-footer">
                            <img class="img-footer" src="{{URL::to('public/uploads/product/'.$foot_pro->product_image)}}" alt="" />
                            <a class="a-footer" href="{{URL::to('/chi-tiet-san-pham/'.$foot_pro->product_id)}}">{{$foot_pro->product_name}}</a>
                        </p>
                    @endforeach

                </div>
            </div>
        </div>
    </footer><!--/Footer-->
    {{-- js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    {{-- Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    {{-- Separate --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/usm/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>      
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    {{-- lightslider js --}}
    <script type="text/javascript" src="{{asset('public/lightslider/js/lightslider.js')}}"></script> 
    <script type="text/javascript" src="{{asset('public/lightslider/js/lightgallery-all.min.js')}}"></script> 
    <script type="text/javascript" src="{{asset('public/lightslider/js/prettify.js')}}"></script> 

    <script type="text/javascript" src="{{asset('public/lightslider/giaodien/product.js')}}"></script> 
    
    {{-- end lightslider js--}}
    
    {{-- Chức năng ajax --}}
    <script src="{{asset('public/ajax/page/auto_complete.js')}}"></script>
    <script src="{{asset('public/ajax/page/filter_product.js')}}"></script>
    <script src="{{asset('public/ajax/page/order.js')}}"></script>
    <script src="{{asset('public/ajax/page/cart.js')}}"></script>
    <script src="{{asset('public/ajax/page/delivery.js')}}"></script>
    <script src="{{asset('public/ajax/page/feeship.js')}}"></script>

    <script src="{{asset('public/ajax/page/giaodien/permanent_menu.js')}}"></script>
    
    {{-- end ajax --}}
</body>
</html>