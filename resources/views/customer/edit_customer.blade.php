@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
</script>
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        @foreach($edit_customer as $key=> $edit_cus)
                        <header class="panel-heading">
                            <h2 class="h2-title">Chỉnh sửa người dùng: {{$edit_cus->customer_name}}</h2>
                        </header>
                       
                        <div class="">
                            <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
                            <a class="link-href-admin" href="{{URL::to('/all-customer-account')}}">Danh sách người dùng</a>/
                            <a  class="link-href-admin" href="">Chi tiết người dùng {{$edit_cus->customer_name}}</a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="panel-body">
                                    
                                    <div class="position-center">
                                        <form role="form" name="editCate"action="{{URL::to('/all-customer-account/')}}" onmousemove="validation_category();">
                                            {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="lable-title">Tên người dùng</label>
                                            <input type="text" value='{{$edit_cus->customer_name}}'  name=''class="form-control" id="" placeholder="Tên người dùng" readonly="false" onkeyup="ChangeToSlug();">
                                            <b id=""></b>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Email</label>
                                            <input type="text" value='{{$edit_cus->customer_email}}'name="" class="form-control" id="" placeholder="Email" readonly="false">
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Số điện thoại</label>
                                            <input type="text" value='{{$edit_cus->customer_phone}}'name="" class="form-control" id="" placeholder="Số điện thoại" readonly="false">
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Mật khẩu</label>
                                            <input type="text" value='{{($edit_cus->customer_password)}}'name="" class="form-control" id="" placeholder="Mật khẩu" readonly="false">
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Địa chỉ</label>
                                            <input type="text" value='{{($edit_cus->customer_address)}}'name="" class="form-control" id="" placeholder="Địa chỉ" readonly="false">
                                        </div>

                                        <button type="submit" name="add_customer" class="btn-submit-function" onmousemove="validation_category();"><i class="fa fa-edit"></i> Quay lại danh sách</button>
                                        </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </section>

            </div>
@endsection