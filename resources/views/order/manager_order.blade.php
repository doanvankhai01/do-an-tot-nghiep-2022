@extends('admin.admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="h2-title">Danh sách đơn hàng</h2>
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
          <form action="{{URL::to('/search-order-on-admin-layout')}}" method="POST">
            @csrf
            <input type="hidden" value="{{URL::to('')}}" name="url" class="form-control url" placeholder="url">
            <div class="search_box pull-right">
              <input type="text" class="btn-function-infomation" name="search_order_submit" id="keywords_order" placeholder="Nhập mã đơn hàng">
              <input class="btn-function-infomation" type="submit" value="Tìm kiếm">
            </div>
            <div class="div-auto-complete-search" style="" id="search_order_admin_ajax"></div>
          </form>
      </div>
    </div>
    <div class="">
      <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
      <a  class="link-href-admin" href="">Đơn hàng</a>
    </div>
    <div class="table-responsive">
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
          <table class="tbl-function-infomation">
            <thead>
              <tr>
                <th class="th-infomation-title">Thứ tự</th>
                <th class="th-infomation-title">Mã đơn hàng</th>
                <th class="th-infomation-title">Tình trạng đơn hàng</th>
                <th class="th-infomation-title">Ngày đặt hàng</th>
                <th class="th-infomation-title" style="width:15%;">Chức năng</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order as $key => $ode)
              <tr>
                <td class="td-infomation-title"><i>{{$i++ + 1}}</i></td>
                <td class="td-infomation-title">{{ $ode->order_code }}</td>
                <td class="td-infomation-title">
                  @if($ode->order_status == 0)
                    <p class="text-primary">Đơn hàng mới</p>
                  @elseif( $ode->order_status == 1)
                  <p class="text-warning">Đã xem-đang xử lí<p>
                  @elseif( $ode->order_status == 2)
                  <p class="text-success">Đã giao hàng-thanh toán</p>
                  @elseif( $ode->order_status == 3)
                  <p class="text-danger">Đơn đã hủy</p>
                  @else
                  <p class="text-danger">Không rõ tình trạng</p>
                  @endif
                </td>
                <td class="td-infomation-title">{{ $ode->created_at }}</td>
                <td class="td-infomation-title">
                  <a href="{{URL::to('/view-order/'.$ode->order_code)}}" class="edit-delete-function" ui-toggle-class="">
                    <i class="fa fa-eye text-success text-active"></i>
                  Chi tiết</a>
                  <a onclick="return confirm('Bạn có muốn xóa sản phẩm, sản phẩm sẽ được lưu trữ trong thùng rác?')"  href="{{URL::to('/unactive-waste-basket-order/'.$ode->order_code)}}" class="edit-delete-function" ui-toggle-class="">
                    <i class="material-icons text-danger">delete_forever</i>
                    Xóa
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <footer class="panel-footer">
        <div class="product-paginate">
            {{$order->links()}}              
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