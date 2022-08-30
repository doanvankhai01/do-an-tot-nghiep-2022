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
                <h2 class="h2-title">Thêm hình ảnh phụ</h2>
            </header>
                <div class="">
                    <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
                    <a class="link-href-admin" href="{{URL::to('/all-product')}}">Sản phẩm</a>/
                    <a  class="link-href-admin" href="">Thêm hình ảnh phụ</a>
                </div>
                <div class="position-center">
                    <div class="card">
                        <div class="card-body">
                            <form role="form" action="{{URL::to('/add-gallery/'.$pro_id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{URL::to('')}}" name="url" class="form-control url" placeholder="url">
                                <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id" id="pro_id">
                                <div class="row">
                                    <div class="col-sm-3">

                                    </div>
                                    <div class="col-sm-6">
                                        <input type="file" id="file" class="btn-function-infomation" style="width: 100%" name="file[]" accept="image/*" multiple>
                                        {{-- name là một chuỗi file --}}
                                        {{-- accept là chỉ cho phép file là hình ảnh với bất * là kì đuôi ảnh nào --}}
                                        {{-- multiple là cho phép nhập nhiều dữ liệu --}}
                                        <div id="error_gallery"></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="submit" name="upload" class="btn-function-infomation upload_image" value="Tải ảnh" >
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form role="form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{URL::to('')}}" name="url" class="form-control url" placeholder="url">
                                <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id" id="pro_id">
                                <div class="gallery_load" id="gallery_load">
                                    <table class="tbl-function-infomation">
                                        <thead>
                                          <tr>
                                            <th class="th-infomation-title">Tên hình ảnh phụ</th>
                                            <th class="th-infomation-title">Đường dẫn</th>
                                            <th class="th-infomation-title">Hình ảnh</th>
                                            <th class="th-infomation-title">Quản lý</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
@section('script')
<script src="{{asset('public/ajax/dashboard/gallery.js')}}"></script>
@endsection