@extends('admin.admin_layout')
@section('admin_content')
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
                            <h2 class="h2-title">Thêm vận chuyển</h2>
                        </header>
                         
                        <div class="">
                            <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
                            <a  class="link-href-admin" href="">Phí ship hàng</a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="position-center">
                                    <form>
                                        @csrf 
                                        <input type="hidden" value="{{URL::to('')}}" name="url" class="form-control url" placeholder="url">
                                        <div class="form-group">
                                            <label class="lable-title">Chọn thành phố</label>
                                            <select name="province" id="province" class="form-control input-sm m-bot15 province choose search">
                                                <!--
                                                    thêm provice choose sau tên class để tránh trùng tên với các hàm trong js và css
                                                    đồng thời giúp chương trình ajax tránh bị lỗi.
                                                -->
                                                    <option value="">--Chọn tỉnh thành phố--</option>
                                                @foreach($province as $key => $pro)
                                                    <option value="{{$pro->province_id}}">{{$pro->province_name}}</option>
                                                @endforeach
                                                    
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Chọn quận huyện</label>
                                            <select name="district" id="district" class="form-control input-sm m-bot15 district choose search">
                                                    <option value="">--Chọn quận huyện--</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Chọn xã phường</label>
                                            <select name="town" id="town" class="form-control input-sm m-bot15 town search">
                                                    <option value="">--Chọn xã phường--</option>   
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="lable-title">Phí vận chuyển</label>
                                            <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1" placeholder="Phí vận chuyển">
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <button type="button" name="add_delivery" class="btn-function-infomation add_delivery"><i class="fa fa-plus"></i> Thêm phí vận chuyển</button>
                                            </div>
                                            <div class="col-sm-5">
                                                             
                                            </div>
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-3">
                                                
                                            </div>
                                        </div>
                                        <br>
                                    </form>
                                </div>
                                
                            </div>
                            
                        </div>
                        <h2 class="h2-title">Danh sách phí vận chuyển</h2>
                        <div id="load_delivery">
                        </div>
                        {{-- <h2 class="h2-title">Danh sách phí vận chuyển đã có</h2>
                        <div id="loadd_delivery">
                        </div> --}}
                    </section>

            </div>
@endsection
@section('script')
<script src="{{asset('public/ajax/dashboard/feeship.js')}}"></script>
@endsection