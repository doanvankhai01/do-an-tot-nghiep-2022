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
<div class="card">
    <div class="card-body">
        <div class="container-fuild">
        
            <h2 class="h2-title">Thống kê doanh số</h2>
            <form autocomplete="off">
                {{-- autocomplete là những dữ liệu trong form không được tự điền --}}
                @csrf
                <input type="hidden" value="{{URL::to('')}}" name="url" class="form-control url" placeholder="url">
                <div class="row">
                    <div class="col-sm-2">
                        <p class="lable-title">Từ ngày:</p>
                        <input type="text" id="datepicker1" class="btn-function-infomation date-start">
                    </div>
                    <div class="col-sm-2">
                        <p class="lable-title">Đến ngày:</p>
                        <input type="text" id="datepicker2" class="btn-function-infomation date-end">
                    </div>
                    <div class="col-sm-2">
                        <p class="lable-title">Tìm kiếm:</p>
                        <input type="button" id="btn-search-statistical" value="Lọc kết quả"class="btn-function-infomation btn-search-statistical">
                    </div>
                    <div class="col-sm-2">
                        <p class="lable-title">Lọc:</p>
                        <select name="sort" id="sort" class="btn-function-infomation filter-statistical">
                            <option value="none">--- Lọc theo ---</option>
                            <option value="bay_ngay">Doanh thu 7 ngày gần đây</option>
                            <option value="thang_nay">Doanh thu tháng này</option>
                            <option value="thang_truoc">Doanh thu tháng trước</option>
                            <option value="hai_thang_truoc">Doanh thu 2 tháng trước</option>
                            <option value="ba_thang_truoc">Doanh thu 3 tháng trước</option>
                            <option value="sau_thang_truoc">Doanh thu 6 tháng trước</option>
                            <option value="ba_sau_nam_ngay">Doanh thu 365 ngày</option>
                            {{-- {{Request::url()}} là yêu cầu lấy đường dẫn hiện tại --}}
                        </select>
                    </div>
                </div>
                
            </form>
            <div class="row">
                <div class="col-sm-12">
                    <div id="mychart" style="height: 500px;"></div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
@section('script')
{{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> --}}
<script src="{{asset('public/ajax/dashboard/datepicker/datepicker.js')}}"></script>
<script src="{{asset('public/ajax/dashboard/statistical.js')}}"></script>
{{-- Biểu đồ doanh số - morris --}}

{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> --}}
<script src="{{asset('public/ajax/dashboard/morris/raphael.js')}}"></script>
<script src="{{asset('public/ajax/dashboard/morris/morris.0.5.1.js')}}"></script>
{{-- <script src="{{asset('public/ajax/dashboard/morris/morris.min.js')}}"></script> --}}
{{-- Hiển thị ngày --}}
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
@endsection