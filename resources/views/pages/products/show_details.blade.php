@extends('layout')
@section('content')
@foreach($product_details as $key => $value)

	<br>
	<h2 class="title-product-home">Chi tiết sản phẩm {{$value->product_name}}</h2>           
    </div>	
	<div class="container container-detail"><!--product-details-->
		<hr>
		<div class="row">
			<div class="col-sm-5">
				<ul id="imageGallery">
					<li data-thumb="{{URL::to('/public/uploads/product/'.$value->product_image)}}" data-src="{{URL::to('/public/uploads/product/'.$value->product_image)}}">
						<img alt="{{$value->product_slug}}" style="width:100%; height:500px;" src="{{URL::to('/public/uploads/product/'.$value->product_image)}}" />
					</li>
					@foreach($gallery as $key => $galley)
					<li data-thumb="{{URL::to('/public/uploads/gallery/'.$galley->gallery_image)}}" data-src="{{URL::to('/public/uploads/gallery/'.$galley->gallery_image)}}">
						<img alt="{{$galley->gallery_slug}}" style="width:100%; height:500px;" src="{{URL::to('/public/uploads/gallery/'.$galley->gallery_image)}}" />
					</li>
					@endforeach
				</ul>
			</div>
			<div class="col-sm-7 text-font-title-detail">
				<div class="product-information"><!--/product-information-->
					<h2><b>{{$value->product_name}}</b></h2>
					<p>Mã ID: {{$value->product_id}}</p>
					<form action="{{URL::to('/save-cart')}}" method="POST">
						@csrf
						<input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
						<input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
						<input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
						<input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
						<input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
						<p class=""><b>Giá:</b> {{number_format($value->product_price).' VNĐ'}}</p>
						<label class=""><b>Số lượng còn trong kho:{{$value->product_quantity}}</b></label>
						<input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}} detail-qty-pagehome" value="1" />
						<input name="productid_hidden" type="hidden" value="{{$value->product_id}}" />
						<button type="button" class="add-to-cart button-detail-product" data-id_product="{{$value->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
					</form>
					<p class=><b>Thương hiệu:</b> {{$value->brand_name}}</p>
					<p class=><b>Danh mục:</b> {{$value->category_name}}</p>
					<p class=><b>Thông tin sản phẩm:</b> </p>
					<div>
						<span>{!!$value->product_desc!!}</span>
					</div>
				</div><!--/product-information-->
			</div>
		</div>
		<hr>	
	</div><!--/product-details-->

	<div class="container">
		<h2 class="title-product-home">Thông tin thêm</h2>
		<br>
		<!-- Nav pills -->
		<ul class="nav nav-pills detail-content-pagehome" role="tablist">
			<li class="nav-item li-detail">
			<a class="detail-content-item-pagehome active" data-bs-toggle="pill" href="#details">Mô tả sản phẩm</a>
			</li>
			<li class="nav-item li-detail">
			<a class="detail-content-item-pagehome " data-bs-toggle="pill" href="#reviews">Đánh giá</a>
			</li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div id="details" class="container tab-pane active"><br>
				<h4 class="title-desc-detail-pagehome">Mô tả sản phẩm</h4>
				<hr>
				<p>{!!$value->product_content!!}</p>
			</div>
			<div id="reviews" class="container tab-pane fade"><br>
				<h3 class="title-desc-detail-pagehome">Đánh giá</h3>
				<hr>
				<p>Đánh giá</p>
			</div>
		</div>
	</div>
@endforeach
	
	<div class="row product-home"><!--features_items-->
		<hr>
			<h2 class="title-product-home">Sản phẩm liên quan</h2>
		@foreach($relate as $key => $lienquan)
		<div class="col-sm-3">
			<div class="product-home-cart">
				<form class="form-product-home-cart">
					@csrf
					<input type="hidden" value="{{$lienquan->product_id}}" class="cart_product_id_{{$lienquan->product_id}}">
					<input type="hidden" value="{{$lienquan->product_name}}" class="cart_product_name_{{$lienquan->product_id}}">
					<input type="hidden" value="{{$lienquan->product_image}}" class="cart_product_image_{{$lienquan->product_id}}">
					<input type="hidden" value="{{$lienquan->product_price}}" class="cart_product_price_{{$lienquan->product_id}}">
					<input type="hidden" value="1" class="cart_product_qty_{{$lienquan->product_id}}">
					<a class="cart-product-home"href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_id)}}">
						<img class="card-img-top" src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
						<h2 class="rename-to-dot">{{$lienquan->product_name}}</h2>
						<h4>{{number_format($lienquan->product_price).' '.'VNĐ'}}</h4>
					</a>
					
				</form> 
				<div class="button-cart-product-home">
					<!-- <a href="#" class="btn btn-de  fault add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a> -->
					<button type="button" class="add-to-cart button-cart-product-home" data-id_product="{{$lienquan->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
					<!-- data-feeship_id, trong đó data- là bắt buộc, còn feeship_id là tên và có thế thay đổi theo ý muốn người lập trình -->
					<!-- data-id_product được gọi tại ajax layout.blade.php -->
				</div>
			</div>
			<div>
				<br>
			</div>
		</div>
		@endforeach
		<div class="button-cart-product-full-home">
		</div>
	</div><!--features_items-->
		
@endsection


