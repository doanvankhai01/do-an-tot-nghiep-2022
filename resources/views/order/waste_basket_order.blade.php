@extends('admin.admin_layout')
@section('admin_content')
<?php
  $message = Session::get("message");
  if($message){
      echo '<script type="text/javascript">window.setTimeout(function test(){'.$message.'},100);</script>';
      Session::put('message',null);
  }
?>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="h2-title">Thùng rác: Đơn hàng</h2>
    </div>
    <div class="row w3-res-tb">
    </div>
    <div class="row">
      <div class="col-sm-5">
        <select class="btn-function-infomation">>
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn-function-infomation">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="">
          <input type="text" class="btn-function-infomation" placeholder="Tìm kiếm">
          <span class="">
            <button class="btn-function-infomation" type="button">Tìm kiếm</button>
          </span>
        </div>
      </div>
      
    </div>
    <div class="">
      <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
      <a  class="link-href-admin" href="">Đơn hàng</a>
    </div>
    <div class="table-responsive">
      <div class="card">
        <div class="card-body">
          <table class="tbl-function-infomation">
            <thead>
              <tr>
                <th class="th-infomation-title">Thứ tự</th>
                <th class="th-infomation-title">Mã đơn hàng</th>
                <th class="th-infomation-title">Tình trạng đơn hàng</th>
                <th class="th-infomation-title">Ngày đặt hàng</th>
                <th class="th-infomation-title" style="width:20%;">Chức năng</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order as $key => $ode)
              <tr>
                <td class="td-infomation-title"><i>{{$i++ + 1}}</i></td>
                <td class="td-infomation-title">{{ $ode->order_code }}</td>
                <td class="td-infomation-title">
                  @if( $ode->order_status == 0)
                    Đơn hàng mới
                  @else
                    Đã xử lý
                  @endif
                </td>
                <td class="td-infomation-title">{{ $ode->created_at }}</td>
                <td class="td-infomation-title">
                  <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?Đơn hàng sẽ mất và không thể khôi phục lại!')" href="{{URL::to('#')}}" class="edit-delete-function" ui-toggle-class="">
                    <i class="material-icons text-danger">delete_forever</i>
                    Xóa vĩnh viễn
                  </a>
                  <a onclick="return confirm('Bạn có muốn khôi phục đơn hàng này không?')" href="{{URL::to('/active-waste-basket-order/'.$ode->order_code)}}" class="edit-delete-function" ui-toggle-class="">
                    <i class="material-icons text-success">restore</i>
                    Khôi phục
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">  
            {{$order->links()}}              
          </div>
        </div>
      </footer>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="{{asset('public/ajax/dashboard/filter.js')}}"></script>
<script src="{{asset('public/ajax/dashboard/auto_complete.js')}}"></script>
<script src="{{asset('public/ajax/dashboard/order.js')}}"></script>
@endsection