@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
</script>
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="h2-title">Thêm tài khoản quản trị</h2>
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
                                        <div class="form-group">
                                            <label class="lable-title">Tên quản trị viên</label>
                                            <input type="text" name="admin_name" class="form-control admin_name" id="admin_name" onkeyup="" placeholder="Tên quản trị viên">
                                            <b id="brand_name_error"></b>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Đường dẫn URL</label>
                                            <input type="text" name="admin_slug" class="form-control admin_slug" id="admin_slug" placeholder="ten-quan-tri-vien" readonly="false">
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Đường dẫn URL</label>
                                            <input type="text" name="admin_slug" class="form-control admin_slug" id="admin_slug" placeholder="ten-quan-tri-vien" readonly="false">
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