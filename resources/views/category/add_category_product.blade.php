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
                <header class="">
                    <h2 class="h2-title">Thêm danh mục sản phẩm</h2>
                </header>
                <div class="">
                    <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
                    <a class="link-href-admin" href="{{URL::to('/all-category-product')}}">Danh mục</a>/
                    <a  class="link-href-admin" href="">Thêm danh mục</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="panel-body">
                                {{-- <form id="add_category"role="form" name="addCate" action="{{URL::to('/save-category-product')}}"  method="post" onmousemove="validation_category();">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="lable-title">Tên danh mục</label>
                                    <input type="text" name="category_product_name" class="form-control" id="category_name" placeholder="Tên danh mục"onkeyup="ChangeToSlug();">
                                    <b id="category_name_error"></b>
                                    <!-- <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền đủ từ 3 kí tự trở lên!" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục"> -->
                                </div>
                                <div class="form-group">
                                    <label class="lable-title">Đường dẫn URL</label>
                                    <input type="text" name="category_product_slug" class="form-control" id="category_slug" placeholder="ten-danh-muc" readonly="false">
                                </div>
                                <div class="form-group" >
                                    <label class="lable-title">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="category_product_desc" id="category_desc" placeholder="Mô tả danh mục"onmousemove="validation_category();"></textarea>
                                    <b id="category_desc_error"></b>
                                </div>
                                <div class="form-group">
                                    <label class="lable-title">Hiển thị</label>
                                        <select name="category_product_status" class="form-control input-sm m-bot15" onclick="validation_category();" >
                                            <option value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                                <button type="submit" name="add_category_product" class="btn-submit-function" onmousemove="validation_category();"><i class="fa fa-plus"></i> Thêm danh mục</button>
                                </form> --}}

                                <form id="add_category" onmousemove="validation_category();">
                                    @csrf
                                    <input type="hidden" value="{{URL::to('')}}" name="url" class="form-control url" placeholder="url">
                                <div class="form-group">
                                    <label class="lable-title">Tên danh mục</label>
                                    <input type="text" name="category_product_name" class="form-control category_name" id="category_name" placeholder="Tên danh mục"onkeyup="Category();">
                                    <b id="category_name_error"></b>
                                    <!-- <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền đủ từ 3 kí tự trở lên!" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục"> -->
                                </div>
                                <div class="form-group">
                                    <label class="lable-title">Đường dẫn URL</label>
                                    <input type="text" name="category_product_slug" class="form-control category_slug" id="category_slug" placeholder="ten-danh-muc" readonly="false">
                                </div>
                                <div class="form-group" >
                                    <label class="lable-title">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" class="form-control category_desc" name="category_product_desc" id="category_desc" placeholder="Mô tả danh mục"onmousemove="validation_category();"></textarea>
                                    <b id="category_desc_error"></b>
                                </div>
                                <div class="form-group">
                                    <label class="lable-title">Hiển thị</label>
                                        <select name="category_product_status" class="form-control input-sm m-bot15 category_status" onclick="validation_category();" >
                                            <option value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                                <button type="submit" name="add_category_product" class="btn-submit-function add_category" onmousemove="validation_category();"><i class="fa fa-plus"></i> Thêm danh mục</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

    </div>
@endsection
@section('script')
<script src="{{asset('public/ajax/dashboard/category.js')}}"></script>
@endsection