@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
</script>
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="h2-title">Thêm Thương hiệu sản phẩm</h2>
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
                                <a class="link-href-admin" href="{{URL::to('/all-brand-product')}}">Thương hiệu</a>/
                                <a  class="link-href-admin" href="">Thêm thương hiệu</a>
                            </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="position-center">
                                    {{-- <form role="form" action="{{URL::to('/save-brand-product')}}" method="post" onmousemove="validation_brand();">
                                        {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="lable-title">Tên Thương hiệu</label>
                                        <input type="text" name="brand_product_name" class="form-control" id="brand_name" onkeyup="Brand();" placeholder="Tên Thương hiệu">
                                        <b id="brand_name_error"></b>
                                    </div>
                                    <div class="form-group">
                                        <label class="lable-title">Đường dẫn URL</label>
                                        <input type="text" name="brand_product_slug" class="form-control" id="brand_slug" placeholder="Tên thương hiệu" readonly="false">
                                    </div>
                                    <div class="form-group">
                                        <label class="lable-title">Mô tả Thương hiệu</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="brand_product_desc" id="brand_desc" onkeyup="validation_brand();" placeholder="Mô tả Thương hiệu"></textarea>
                                        <b id="brand_desc_error"></b>
                                    </div>
                                    <div class="form-group">
                                        <label class="lable-title" onclick="validation_brand();">Hiển thị</label>
                                        <select name="brand_product_status" class="form-control input-sm m-bot15">
                                                <option value="0">Hiển thị</option>
                                                <option value="1">Ẩn</option>
                                                
                                        </select>
                                    </div>
                                
                                    <button type="submit" name="add_brand_product" class="btn-submit-function add_brand_product" onmousemove="validation_brand();"><i class="fa fa-plus"></i> Thêm Thương hiệu</button>
                                    </form> --}}
                                    
                                    {{-- AJAX --}}
                                    <form onmousemove="validation_brand();">
                                        @csrf
                                        <input type="hidden" value="{{URL::to('')}}" name="url" class="form-control url" placeholder="url">
                                    <div class="form-group">
                                        <label class="lable-title">Tên Thương hiệu</label>
                                        <input type="text" name="brand_product_name" class="form-control brand_name" id="brand_name" onkeyup="Brand();" placeholder="Tên Thương hiệu">
                                        <b id="brand_name_error"></b>
                                    </div>
                                    <div class="form-group">
                                        <label class="lable-title">Đường dẫn URL</label>
                                        <input type="text" name="brand_product_slug" class="form-control brand_slug" id="brand_slug" placeholder="Tên thương hiệu" readonly="false">
                                    </div>
                                    <div class="form-group">
                                        <label class="lable-title">Mô tả Thương hiệu</label>
                                        <textarea style="resize: none" rows="8" class="form-control brand_desc" name="brand_product_desc" id="brand_desc" onkeyup="validation_brand();" placeholder="Mô tả Thương hiệu"></textarea>
                                        <b id="brand_desc_error"></b>
                                    </div>
                                    <div class="form-group">
                                        <label class="lable-title" onclick="validation_brand();">Hiển thị</label>
                                        <select name="brand_product_status" class="form-control input-sm m-bot15  brand_status">
                                                <option value="0">Hiển thị</option>
                                                <option value="1">Ẩn</option>
                                                
                                        </select>
                                    </div>
                                
                                    <button type="submit" name="add_brand_product" class="btn-submit-function add_brand_product" onmousemove="validation_brand();"><i class="fa fa-plus"></i> Thêm Thương hiệu</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

            </div>
@endsection
@section('script')
<script src="{{asset('public/ajax/dashboard/brand.js')}}"></script>
@endsection