@extends('layout')
@section('content')
<style>
</style>
<hr>
<div class="row product-home"><!--features_items-->
    <h2 class="title-product-home">Tất cả sản phẩm</h2>
    <div class="row">
        <div class="col-sm-4">
            <label for="amount" class="filter-title">Sắp xếp theo</label>
            <form >
                @csrf
                <select name="sort" id="sort" class="filter-product-home">
                    <option value="{{Request::url()}}?sort_by=none">--- Lọc theo ---</option>
                    <option value="{{Request::url()}}?sort_by=tang_dan">Lọc theo giá từ nhỏ nhất đên lớn nhất</option>
                    <option value="{{Request::url()}}?sort_by=giam_dan">Lọc theo giá từ lớn nhất đên nhỏ nhất</option>
                    <option value="{{Request::url()}}?sort_by=a_den_z">Lọc theo tên từ A đến Z</option>
                    <option value="{{Request::url()}}?sort_by=z_den_a">Lọc theo tên từ Z đến A</option>
                    {{-- {{Request::url()}} là yêu cầu lấy đường dẫn hiện tại --}}
                </select>
                <p></p>
            </form>
        </div>
    </div>
    @foreach($all_product as $key => $product)
    <div class="col-sm-3">
        <div class="product-home-cart">
            <form class="form-product-home-cart">
                @csrf
                <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                <a class="cart-product-home"href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
                    <img class="card-img-top" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                    <h2 class="rename-to-dot">{{$product->product_name}}</h2>
                    <h4>{{number_format($product->product_price).' '.'VNĐ'}}</h4>
                </a>
                
            </form> 
            <div class="button-cart-product-home">
                <!-- <a href="#" class="btn btn-de  fault add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a> -->
                <button type="button" class="add-to-cart button-cart-product-home" data-id_product="{{$product->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
                <!-- data-feeship_id, trong đó data- là bắt buộc, còn feeship_id là tên và có thế thay đổi theo ý muốn người lập trình -->
                <!-- data-id_product được gọi tại ajax layout.blade.php -->
            </div>
        </div>
        <div>
            <br>
        </div>
    </div>
    @endforeach
    <div class="product-paginate">
        {{$all_product->links()}}
    </div>
</div><!--features_items-->
<!--/recommended_items-->
<style>
    
</style>
@endsection