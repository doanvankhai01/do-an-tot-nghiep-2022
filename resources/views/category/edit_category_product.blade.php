@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
</script>
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        @foreach($edit_category_product as $key=> $edit_value)
                        <header class="panel-heading">
                            <h2 class="h2-title">Chỉnh sửa danh mục: {{$edit_value->category_name}}</h2>
                        </header>
                       
                        <div class="">
                            <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
                            <a class="link-href-admin" href="{{URL::to('/all-category-product')}}">Danh mục</a>/
                            <a  class="link-href-admin" href="">Chỉnh sửa danh mục -> {{$edit_value->category_slug}}</a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="panel-body">
                                    
                                    <div class="position-center">
                                        {{-- <form role="form" name="editCate"action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post" onmousemove="validation_category();">
                                            {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="lable-title">Tên danh mục</label>
                                            <input type="text" value='{{$edit_value->category_name}}'  name='category_product_name'class="form-control" id="category_name" placeholder="Tên danh mục" onkeyup="ChangeToSlug();">
                                            <b id="category_name_error"></b>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Đường dẫn URL</label>
                                            <input type="text" value='{{$edit_value->category_slug}}'name="category_product_slug" class="form-control" id="category_slug" placeholder="Tên danh mục" readonly="false">
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Mô tả danh mục</label>
                                            <textarea style="resize: none" rows="8" class="form-control"  name="category_product_desc" id="category_desc" placeholder="Mô tả danh mục" 	onmousemove="validation_category();">{{$edit_value->category_desc}}</textarea>
                                            <b id="category_desc_error"></b>
                                        </div>
                                        <button type="submit" name="add_category_product" class="btn-submit-function" onmousemove="validation_category();"><i class="fa fa-edit"></i> Cập nhật danh mục</button>
                                        </form> --}}

                                        <form role="form" onmousemove="validation_category();">
                                            @csrf
                                            <input type="hidden" value="{{$edit_value->category_id}}" name="url" class="form-control category_id" placeholder="url">
                                            <input type="hidden" value="{{URL::to('')}}" name="url" class="form-control url" placeholder="url">
                                        <div class="form-group">
                                            <label class="lable-title">Tên danh mục</label>
                                            <input type="text" value='{{$edit_value->category_name}}'  name='category_product_name'class="form-control category_name" id="category_name" placeholder="Tên danh mục" onkeyup="Category();">
                                            <b id="category_name_error"></b>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Đường dẫn URL</label>
                                            <input type="text" value='{{$edit_value->category_slug}}'name="category_product_slug" class="form-control category_slug" id="category_slug" placeholder="Tên danh mục" readonly="false">
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Mô tả danh mục</label>
                                            <textarea style="resize: none" rows="8" class="form-control category_desc"  name="category_product_desc" id="category_desc" placeholder="Mô tả danh mục" 	onmousemove="validation_category();">{{$edit_value->category_desc}}</textarea>
                                            <b id="category_desc_error"></b>
                                        </div>
                                        <button type="submit" name="add_category_product" class="btn-submit-function update_category" onmousemove="validation_category();"><i class="fa fa-edit"></i> Cập nhật danh mục</button>
                                        </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </section>

            </div>
@endsection
@section('script')
<script src="{{asset('public/ajax/dashboard/category.js')}}"></script>
@endsection