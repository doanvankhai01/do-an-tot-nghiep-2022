
@extends('layout')
@section('content')
<style>
</style>
<hr>
<div class="row product-home"><!--features_items-->
    @foreach($category_name as $key => $name)
        <h2 class="title-product-home">Sản phẩm trong danh mục: {{$name->category_name}}</h2>
    @endforeach
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
    @foreach($category_by_id as $key => $cate_by_id)
    <div class="col-sm-3 col-col-333">
        <div class="product-home-cart">
            <form class="form-product-home-cart">
                @csrf
                <input type="hidden" value="{{$cate_by_id->product_id}}" class="cart_product_id_{{$cate_by_id->product_id}}">
                <input type="hidden" value="{{$cate_by_id->product_name}}" class="cart_product_name_{{$cate_by_id->product_id}}">
                <input type="hidden" value="{{$cate_by_id->product_image}}" class="cart_product_image_{{$cate_by_id->product_id}}">
                <input type="hidden" value="{{$cate_by_id->product_price}}" class="cart_product_price_{{$cate_by_id->product_id}}">
                <input type="hidden" value="1" class="cart_product_qty_{{$cate_by_id->product_id}}">
                <a class="cart-product-home"href="{{URL::to('/chi-tiet-san-pham/'.$cate_by_id->product_id)}}">
                    <img class="card-img-top" src="{{URL::to('public/uploads/product/'.$cate_by_id->product_image)}}" alt="" />
                    <h2 class="rename-to-dot">{{$cate_by_id->product_name}}</h2>
                    <h4>{{number_format($cate_by_id->product_price).' '.'VNĐ'}}</h4>
                </a>
                
            </form> 
            <div class="button-cart-product-home">
                <!-- <a href="#" class="btn btn-de  fault add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a> -->
                <button type="button" class="add-to-cart button-cart-product-home" data-id_product="{{$cate_by_id->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
                <!-- data-feeship_id, trong đó data- là bắt buộc, còn feeship_id là tên và có thế thay đổi theo ý muốn người lập trình -->
                <!-- data-id_product được gọi tại ajax layout.blade.php -->
            </div>
        </div>
        <div>
            <br>
        </div>
    </div>
    @endforeach
    <div>
        {{$category_by_id ->links()}}  
    </div>
</div><!--features_items-->
<!--/recommended_items-->
@endsection