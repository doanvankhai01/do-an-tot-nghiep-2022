@extends('layout')
@section('content')
<br>
<hr>
<div class="row product-home"><!--features_items-->
    <h2 class="title-product-home">Sản phẩm mới nhất</h2>
    @foreach($all_product as $key => $product)
    <div class="col-sm-3 col-col-333">
        <div class="product-home-cart">
            <form class="form-product-home-cart">
                @csrf
                <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                <a class="cart-product-home"href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
                    <img class="card-img-top" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                    <span><h2 class="rename-to-dot">{{$product->product_name}}</h2><span>
                    <h4>{{number_format($product->product_price).' '.'VNĐ'}}</h4>
                </a>
            </form> 
            <div class="button-cart-product-home">
           
                <!-- <a href="#" class="btn btn-de  fault add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a> -->
                <button type="button" class="add-to-cart button-cart-product-home" data-id_product="{{$product->product_id}}" name="add-to-cart" >Thêm giỏ hàng</button>
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
        {{-- <button type="button" class="full-product button-cart-product-full-home" data-full_id_product="{{$product->product_id}}" name="add-to-cart">Xem tất cả sản phẩm</button> --}}
        <a class="button-cart-product-full-home"href="{{URL::to('/full-all-show-product/')}}">
            Hiển thị tất cả sản phẩm
        </a>
    </div>
</div><!--features_items-->
<!--/recommended_items-->
@endsection