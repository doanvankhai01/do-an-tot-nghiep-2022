@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
</script>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="h2-title">Thêm Slider</h2>
            </header>
            <?php
                $message = Session::get("message");
                if($message){
                    echo '<script type="text/javascript">window.setTimeout(function test(){'.$message.'},100);</script>';
                    Session::put('message',null);
                }
            ?>
                <div class="">
                    <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
                    <a class="link-href-admin" href="{{URL::to('/manager-slider')}}">Slider</a>/
                    <a  class="link-href-admin" href="">Thêm Slider</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-slider')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="lable-title">Tên slider</label>
                                    <input type="text" name="slider_name" class="form-control" id="slider_name" onkeyup="Slider();" placeholder="Tên danh mục">
                                    <b id="slider_name_error"></b>
                                </div>
                                <div class="form-group">
                                    <label class="lable-title">Hình ảnh Slider</label>
                                    <input type="file" name="slider_image" class="form-control"id="slider_image" onkeyup="validation_slider();">
                                    <b id="slider_image_error"></b>
                                </div>
                                <div class="form-group">
                                    <label class="lable-title">Đường dẫn URL</label>
                                    <input type="text" name="slider_slug" class="form-control" id="slider_slug" placeholder="Tên danh mục"  readonly="false">
                                </div> 
                                <div class="form-group">
                                    <label class="lable-title">Mô tả Slider</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="slider_desc" id="slider_desc" onkeyup="validation_slider();" placeholder="Mô tả sản phẩm"></textarea>
                                    <b id="slider_desc_error"></b>
                                </div>
                                <div class="form-group">
                                    <label class="lable-title">Hiển thị</label>
                                        <select name="slider_status" class="form-control input-sm m-bot15">
                                            <option value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                                <button type="submit" name="add_slider" class="btn-submit-function"><i class="fa fa-plus"></i> Thêm sản phẩm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection