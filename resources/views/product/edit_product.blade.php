@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
</script>
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        @foreach($edit_product as $key => $pro)
                            <header class="panel-heading">
                                <h2 class="h2-title">Chỉnh sửa sản phẩm: {{$pro->product_name}}</h2>
                            </header>
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                                ?>
                            <div class="">
                                <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
                                <a class="link-href-admin" href="{{URL::to('/all-product')}}">Sản phẩm</a>/
                                <a  class="link-href-admin" href="">Sản phẩm -> {{$pro->product_slug}}</a>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="position-center">
                                        
                                        <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="lable-title">Tên sản phẩm</label>
                                            <input type="text" name="product_name" class="form-control" id="product_name" onkeyup="Product();" value="{{$pro->product_name}}">
                                            <b id="product_name_error"></b>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Đường dẫn URL</label>
                                            <input type="text" value="{{$pro->product_slug}}" name="product_slug" class="form-control" id="product_slug" placeholder="Tên danh mục"  readonly="false">
                                        </div> 
                                        <div class="form-group">
                                            <label class="lable-title">Giá sản phẩm</label>
                                            <input type="text" value="{{$pro->product_price}}" name="product_price" class="form-control" id="product_price" onkeyup="validation_product();" >
                                            <b id="product_price_error"></b>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Số lượng</label>
                                            <input type="text" value="{{$pro->product_quantity}}" name="product_quantity" class="form-control" id="product_quantity" onkeyup="validation_product();" >
                                            <b id="product_quantity_error"></b>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Hình ảnh sản phẩm</label>
                                            <input type="file" name="product_image" class="form-control" id="product_image" onkeyup="validation_product();">
                                            <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" height="100" width="100">
                                            <b id="product_image_error"></b>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Mô tả sản phẩm</label>
                                            <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="product_desc" onkeyup="validation_product();">{{$pro->product_desc}}</textarea>
                                            <b id="product_desc_error"></b>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Nội dung sản phẩm</label>
                                            <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="product_content" onkeyup="validation_product();" >{{$pro->product_content}}</textarea>
                                            <b id="product_content_error"></b>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Danh mục sản phẩm</label>
                                            <select name="product_cate" class="form-control input-sm m-bot15">
                                                @foreach($cate_product as $key => $cate)
                                                    @if($cate->category_id==$pro->category_id)
                                                    <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                    @else
                                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                    @endif
                                                @endforeach
                                                    
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Xuất xứ</label>
                                            <select name="product_brand" class="form-control input-sm m-bot15">
                                                @foreach($brand_product as $key => $brand)
                                                    @if($brand->brand_id==$pro->brand_id)
                                                    <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                    @else
                                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                    @endif
                                                @endforeach
                                                    
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Hiển thị</label>
                                            <select name="product_status" class="form-control input-sm m-bot15">
                                                    <option value="0">Hiển thị</option>
                                                    <option value="1">Ẩn</option>
                                                    
                                            </select>
                                        </div>
                                    
                                        <button type="submit" name="add_product"  class="btn-submit-function"><i class="fa fa-edit"></i> Cập nhật sản phẩm</button>
                                        </form>
                                       
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </section>

            </div>
@endsection