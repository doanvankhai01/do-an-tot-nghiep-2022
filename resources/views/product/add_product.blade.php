@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
</script>
<?php
    $message = Session::get("message");
    if($message){
        echo '<script type="text/javascript">window.setTimeout(function test(){'.$message.'},100);</script>';
        Session::put('message',null);
    
    ?>
    <?php
    }
?>
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="h2-title">Thêm sản phẩm</h2>
                        </header>

                            <div class="">
                                <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
                                <a class="link-href-admin" href="{{URL::to('/all-product')}}">Sản phẩm</a>/
                                <a  class="link-href-admin" href="">Thêm sản phẩm</a>
                            </div>
                            <div class="position-center">
                                <div class="card">
                                    <div class="card-body">
                                        <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="lable-title">Tên sản phẩm</label>
                                                <input type="text" name="product_name" class="form-control" id="product_name" onkeyup="Product();" placeholder="Tên danh mục">
                                                <b id="product_name_error"></b>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Đường dẫn URL</label>
                                                <input type="text" name="product_slug" class="form-control" id="product_slug" placeholder="ten-danh-muc"  readonly="false">
                                            </div> 
                                                <div class="form-group">
                                                <label class="lable-title">Giá sản phẩm</label>
                                                <input type="text" name="product_price" class="form-control"id="product_price" onkeyup="validation_product();" placeholder="VNĐ">
                                                <b id="product_price_error"></b>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Số lượng</label>
                                                <input type="text" name="product_quantity" class="form-control" id="product_quantity" onkeyup="validation_product();" >
                                                <b id="product_quantity_error"></b>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Hình ảnh sản phẩm</label>
                                                <input type="file" name="product_image" class="form-control"id="product_image" onkeyup="validation_product();">
                                                
                                                <b id="product_image_error"></b>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Mô tả sản phẩm</label>
                                                <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="product_desc" onkeyup="validation_product();" placeholder="Mô tả sản phẩm"></textarea>
                                                <b id="product_desc_error"></b>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Nội dung sản phẩm</label>
                                                <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="product_content" onkeyup="validation_product();" placeholder="Nội dung sản phẩm"></textarea>
                                                <b id="product_content_error"></b>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Danh mục sản phẩm</label>
                                                <select name="product_cate" class="form-control input-sm m-bot15">
                                                    @foreach($cate as $key => $cate)
                                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                    @endforeach
                                                        
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Nơi sản xuất</label>
                                                <select name="product_brand" class="form-control input-sm m-bot15">
                                                    @foreach($brand as $key => $brand)
                                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
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
                                        
                                            <button type="submit" name="add_product" class="btn-submit-function"><i class="fa fa-plus"></i> Thêm sản phẩm</button>
                                        </form>

                                        {{-- Ajax --}}
                                        {{-- <form role="form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{URL::to('')}}" name="url" class="form-control url" placeholder="url">
                                            <div class="form-group">
                                                <label class="lable-title">Tên sản phẩm</label>
                                                <input type="text" name="product_name" class="form-control product_name" id="product_name" onkeyup="Product();" placeholder="Tên sản phẩm">
                                                <b id="product_name_error"></b>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Đường dẫn URL</label>
                                                <input type="text" name="product_slug" class="form-control product_slug" id="product_slug" placeholder="ten-san-pham"  readonly="false">
                                            </div> 
                                                <div class="form-group">
                                                <label class="lable-title">Giá sản phẩm</label>
                                                <input type="text" name="product_price" class="form-control product_price"id="product_price" onkeyup="validation_product();" placeholder="VNĐ">
                                                <b id="product_price_error"></b>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Số lượng</label>
                                                <input type="text" name="product_quantity" class="form-control product_quantity" id="product_quantity" onkeyup="validation_product();" >
                                                <b id="product_quantity_error"></b>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Hình ảnh sản phẩm</label>
                                                <input type="file" name="product_image" class="form-control product_image"id="product_image" onkeyup="validation_product();">
                                                <div class="show_progress">
                          
                                                </div>    
                                                <div class="row justify-content-center" id="showImage">
        
                                                </div>
                                                                    
                                                <b id="product_image_error"></b>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Mô tả sản phẩm</label>
                                                <textarea style="resize: none" rows="8" class="form-control product_desc" name="product_desc" id="product_desc" onkeyup="validation_product();" placeholder="Mô tả sản phẩm"></textarea>
                                                <b id="product_desc_error"></b>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Nội dung sản phẩm</label>
                                                <textarea style="resize: none" rows="8" class="form-control product_content" name="product_content" id="product_content" onkeyup="validation_product();" placeholder="Nội dung sản phẩm"></textarea>
                                                <b id="product_content_error"></b>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Danh mục sản phẩm</label>
                                                <select name="product_cate" class="form-control input-sm m-bot15 category_id">
                                                    @foreach($cate as $key => $cate)
                                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                    @endforeach
                                                        
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Nơi sản xuất</label>
                                                <select name="product_brand" class="form-control input-sm m-bot15 brand_id">
                                                    @foreach($brand as $key => $brand)
                                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                    @endforeach
                                                        
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="lable-title">Hiển thị</label>
                                                <select name="product_status" class="form-control input-sm m-bot15 product_status">
                                                        <option value="0">Hiển thị</option>
                                                        <option value="1">Ẩn</option>
                                                        
                                                </select>
                                            </div>
                                        
                                            <button type="submit" name="add_product" class="btn-submit-function add_product"><i class="fa fa-plus"></i> Thêm sản phẩm</button>
                                        </form> --}}

                                    </div>
                                </div>
                            </div>
                    </section>

            </div>
@endsection