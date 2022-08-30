@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
    
</script>
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="h2-title">Thêm danh mã giảm giá</h2>
                        </header>
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo "<script type='text/javascript'>
                                            alert('$message');
                                    </script>";
                                Session::put('message',null);
                            }
                        ?>
                        <div class="">
                            <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
                            <a class="link-href-admin" href="{{URL::to('/all-coupon')}}">Mã giảm giá</a>/
                            <a  class="link-href-admin" href="">Thêm mã giảm giá</a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="position-center" >
                                    <form id="add_coupon"role="form" name="addCoupon" action="{{URL::to('/save-coupon')}}"  method="post" onmousemove="">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="lable-title">Tên mã giảm giá</label>
                                            <input type="text" name="coupon_name" class="form-control" id="coupon_name" placeholder="Tên mã giảm giá"onkeyup="">
                                            <b id="coupon_name_error"></b>
                                            <!-- <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền đủ từ 3 kí tự trở lên!" name="coupon_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục"> -->
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="exampleInputEmail1">Slug</label>
                                            <input type="text" name="slug_coupon_product" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                        </div> -->
                                        <div class="form-group" >
                                            <label class="lable-title">Mô tả mã giảm giá</label>
                                            <textarea style="resize: none" rows="8" class="form-control" name="coupon_desc" id="coupon_desc" placeholder="Mô tả mã giảm giá"onmousemove=""></textarea>
                                            <b id="coupon_desc_error"></b>
                                        </div>
                                        <div class="form-group" >
                                            <label class="lable-title">Mã giảm giá</label>
                                            <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Mã giảm giá"onmousemove="">
                                            <b id="coupon_code_error"></b>
                                        </div>
                                        <div class="form-group" >
                                            <label class="lable-title">Số lượng mã</label>
                                            <input class="form-control" name="coupon_time" id="coupon_time" placeholder="Số lượng mã"onmousemove="">
                                            <b id="coupon_time_error"></b>
                                        </div>
                                        <div class="form-group" >
                                            <label class="lable-title">Tính năng mã</label>
                                            <select name="coupon_feature" class="form-control input-sm m-bot15" onclick="" >
                                                    <option value="0">---------Chọn---------</option>
                                                    <option value="1">Giảm theo phần trăm %</option>
                                                    <option value="2">Giảm theo số tiền</option>
                                            </select>
                                        </div>
                                        <div class="form-group" >
                                            <label class="lable-title">Nhập số % hoặc số tiền giảm</label>
                                            <input class="form-control" name="coupon_number" id="coupon_number" placeholder="Giá trị"onmousemove="">
                                            <b id="coupon_number_error"></b>
                                        </div>
                                        <button type="submit" name="add_coupon" class="btn-submit-function" onmousemove=""><i class="fa fa-plus"></i> Thêm mã giảm giá</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

            </div>
@endsection
