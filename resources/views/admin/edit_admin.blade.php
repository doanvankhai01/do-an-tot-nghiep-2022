@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
</script>
<div class="row">
    <div class="col-lg-12">
        
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="h2-title">Chi tiết tài khoản: {{$edit_admin->admin_name}} </h2>
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
                        <a class="link-href-admin" href="{{URL::to('/all-admin')}}">Tài khoản quản trị</a>/
                        <a  class="link-href-admin" href="">Thêm tài khoản quản trị</a>
                    </div>
                <div class="card">
                    <div class="card-body">
                        <div class="position-center">
                            {{-- AJAX --}}
                            <form>
                                @csrf
                                <input type="hidden" value="{{URL::to('')}}" name="url" class="form-control url" placeholder="url">
                                <input type="hidden" value="{{$edit_admin->admin_id}}" name="admin_id" class="form-control admin_id" placeholder="admin_id">
                                <div class="form-group">
                                    <label class="lable-title">Tên quản trị viên</label>
                                    <input type="text" name="admin_name" class="form-control admin_name" id="admin_name" onkeyup="" value="{{$edit_admin->admin_name}}">
                                    <b id="brand_name_error"></b>
                                </div>
                                <div class="form-group">
                                    <label class="lable-title">Đường dẫn URL</label>
                                    <input type="text" name="admin_slug" class="form-control admin_slug" id="admin_slug" value="{{$edit_admin->admin_slug}}">
                                </div>
                                <div class="form-group">
                                    <label class="lable-title">Số điện thoại</label>
                                    <input type="text" name="admin_phone" class="form-control admin_phone" id="admin_phone" value="{{$edit_admin->admin_phone}}">
                                </div>
                                <div class="form-group  ">
                                    <input type="file" id="admin_file" class="btn-function-infomation" style="width: 100%" name="file" accept="image/*">
                                    {{-- name là một chuỗi file --}}
                                    {{-- accept là chỉ cho phép file là hình ảnh với bất * là kì đuôi ảnh nào --}}
                                    {{-- multiple là cho phép nhập nhiều dữ liệu --}}
                                    <img src="{{URL::to('public/uploads/admin/'.$edit_admin->admin_image)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label class="lable-title">EmailL</label>
                                    <input type="text" name="admin_email" class="form-control admin_email" id="admin_email" value="{{$edit_admin->admin_email}}">
                                </div>
                                <div class="form-group">
                                    <label class="lable-title">Mật khẩu</label>
                                    <input type="text" name="admin_password" class="form-control admin_password" id="admin_password" value="{{$edit_admin->admin_password}}">
                                </div>
                                <div class="form-group">
                                    <label class="lable-title" onclick="validation_brand();">Quyền hạn</label>
                                    @if($edit_admin->admin_status == 0)
                                        <select name="brand_product_status" class="form-control input-sm m-bot15  admin_status">
                                            <option value="0" selected>Giám đốc</option>
                                            <option value="1" >Quản lý</option>
                                            <option value="2">Nhân viên</option>
                                        </select>
                                    @elseif($edit_admin->admin_status == 1)
                                        <select name="brand_product_status" class="form-control input-sm m-bot15  admin_status">
                                            <option value="0">Giám đốc</option>
                                            <option value="1" selected>Quản lý</option>
                                            <option value="2">Nhân viên</option>
                                        </select>
                                    @else
                                        <select name="brand_product_status" class="form-control input-sm m-bot15  admin_status">
                                            <option value="0">Giám đốc</option>
                                            <option value="1" >Quản lý</option>
                                            <option value="2" selected>Nhân viên</option>
                                        </select>
                                    @endif
                                </div>
                            
                                <button type="button" name="add_brand_product" class="btn-submit-function update_admin" onmousemove="validation_brand();"><i class="fa fa-plus"></i> Cập nhật tài khoản</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

    </div>
@endsection
@section('script')
<script src="{{asset('public/ajax/dashboard/admin.js')}}"></script>
@endsection