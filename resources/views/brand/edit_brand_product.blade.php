@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
</script>
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        @foreach($edit_brand_product as $key=> $edit_value)
                        <header class="panel-heading">
                            <h2 class="h2-title">Chỉnh sửa Thương hiệu: {{$edit_value->brand_name}}</h2>
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
                            <a  class="link-href-admin" href="">Chỉnh sửa thương hiệu -> {{$edit_value->brand_slug}}</a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="position-center">
                                    {{-- <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="post" onmousemove="validation_brand();">
                                        {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="lable-title">Tên Thương hiệu</label>
                                        <input type="text" value='{{$edit_value->brand_name}}' name='brand_product_name'class="form-control" id="brand_name" onkeyup="Brand();" placeholder="Tên Thương hiệu">
                                        <b id="brand_name_error"></b>
                                    </div>
                                    <div class="form-group">
                                        <label class="lable-title">Đường dẫn URL</label>
                                        <input type="text" value='{{$edit_value->brand_slug}}'name="brand_product_slug" class="form-control" id="brand_slug" placeholder="Tên thương hiệu" readonly="false">
                                    </div>
                                    <div class="form-group">
                                        <label class="lable-title">Mô tả Thương hiệu</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="brand_product_desc" id="brand_desc" onmousemove="validation_brand();" placeholder="Mô tả Thương hiệu">{{$edit_value->brand_desc}}</textarea>
                                        <b id="brand_desc_error"></b>
                                    </div>
                                    <button type="submit"  name="add_brand_product" class="btn-submit-function" onmousemove="validation_brand();"><i class="fa fa-edit"></i> Cập nhật Thương hiệu</button>
                                    </form> --}}
                                    
                                    {{-- Ajax --}}
                                    <form role="form" onmousemove="validation_brand();">
                                        @csrf
                                        <input type="hidden" value="{{URL::to('')}}" name="url" class="form-control url" placeholder="url">
                                        <input type="hidden" value='{{$edit_value->brand_id}}' name='brand_product_id'class="form-control brand_id" id="brand_id" onkeyup="Brand();" placeholder="Id brand">
                                    <div class="form-group">
                                        <label class="lable-title">Tên Thương hiệu</label>
                                        <input type="text" value='{{$edit_value->brand_name}}' name='brand_product_name'class="form-control brand_name" id="brand_name" onkeyup="Brand();" placeholder="Tên Thương hiệu">
                                        <b id="brand_name_error"></b>
                                    </div>
                                    <div class="form-group">
                                        <label class="lable-title">Đường dẫn URL</label>
                                        <input type="text" value='{{$edit_value->brand_slug}}'name="brand_product_slug" class="form-control brand_slug" id="brand_slug" placeholder="đường dẫn" readonly="false">
                                    </div>
                                    <div class="form-group">
                                        <label class="lable-title">Mô tả Thương hiệu</label>
                                        <textarea style="resize: none" rows="8" class="form-control brand_desc" name="brand_product_desc" id="brand_desc" onmousemove="validation_brand();" placeholder="Mô tả Thương hiệu">{{$edit_value->brand_desc}}</textarea>
                                        <b id="brand_desc_error"></b>
                                    </div>
                                    <button type="submit"  name="add_brand_product" class="btn-submit-function btn_update_brand" onmousemove="validation_brand();"><i class="fa fa-edit"></i> Cập nhật Thương hiệu</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </section>

            </div>

@endsection
@section('script')
<script src="{{asset('public/ajax/dashboard/brand.js')}}"></script>
@endsection