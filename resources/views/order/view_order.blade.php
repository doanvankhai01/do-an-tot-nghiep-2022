@extends('admin.admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel-heading">
    <h2 class="h2-title">Đơn hàng: {{$order_code}}</h2>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="h2-title">Thông tin khách hàng(người đặt hàng)</h4>
        </div>
        <div class="table-responsive">
                          <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                                ?>
          <table class="tbl-function-infomation">
            <thead>
              <tr>
                <th class="th-infomation-title">Tên khách hàng</th>
                <th class="th-infomation-title">Email</th>
                <th class="th-infomation-title">Số điện thoại</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="td-infomation-title">{{$customer->customer_name}}</td>
                <td class="td-infomation-title">{{$customer->customer_email}}</td>
                <td class="td-infomation-title">{{$customer->customer_phone}}</td>
              </tr>
            </tbody>
          </table>

        </div>
      
      </div>
    </div>
  </div>
</div>
<br>
<div class="table-agile-info">
  <div class="card">
    <div class="card-body">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="h2-title">Thông tin người nhận</h4>
        </div>
        <div class="table-responsive">
                          <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                                ?>
          <table class="tbl-function-infomation">
            <thead>
              <tr>
                <th class="th-infomation-title">Tên người nhận</th>
                <th class="th-infomation-title">Email</th>
                <th class="th-infomation-title">Số điện thoại</th>
                <th class="th-infomation-title">Địa chỉ</th>
                <th class="th-infomation-title">Ghi chú</th>
                <th class="th-infomation-title">Hình thức thanh toán</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="td-infomation-title">{{$shipping->shipping_name}}</td>
                <td class="td-infomation-title">{{$shipping->shipping_email}}</td>
                <td class="td-infomation-title">{{$shipping->shipping_phone}}</td>
                <td class="td-infomation-title">{{$shipping->shipping_address}}</td>
                <td class="td-infomation-title">{{$shipping->shipping_notes}}</td>
                <td class="td-infomation-title">
                  @if($shipping->shipping_method)
                    Trả tiền mặt
                  @else
                    Chuyển khoản
                  @endif
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="card">
    <div class="card-body">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="h2-title">Danh sách sản phẩm đã đặt</h4>
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
        </div>
        <br>
        <div class="table-responsive">
                          <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                                ?>
          <table class="tbl-function-infomation">
            <thead>
              <tr>
                <th class="th-infomation-title"  style="width:5%;">STT</th>
                <th class="th-infomation-title">Tên sản phẩm</th>
                
                <th class="th-infomation-title" style="width:8.5%;">Hình ảnh</th>
                <th class="th-infomation-title" style="width:8.5%;">Số lượng tồn kho</th>
                <th class="th-infomation-title" style="width:22%;">Số lượng</th>
                <th class="th-infomation-title" style="width:10%;">Giá</th>
                <th class="th-infomation-title" style="width:10%;">Tổng tiền</th>
              </tr>
            </thead>
            <tbody>
            @php
              $i = 0;
              $total =0;
            @endphp
            @foreach($order_details as $key => $ode_detail)
              @php
                $i++;
                $subtotal = $ode_detail->product_price*$ode_detail->product_sales_quantity;
                $total += $subtotal;
              @endphp
              <tr>
                <td class="td-infomation-title color_qty_{{$ode_detail->product_id}}"><i>{{$i}}</i></td>
                <td class="td-infomation-title color_qty_{{$ode_detail->product_id}}">{{$ode_detail->product_name}}</td>
                
                <td class="td-infomation-title color_qty_{{$ode_detail->product_id}}"><img src="{{asset('public/uploads/product/'.$ode_detail->product_image)}}" height="100" width="100"></td>
                <td class="td-infomation-title color_qty_{{$ode_detail->product_id}}">{{$ode_detail->product->product_quantity}}</td>
                <td class="td-infomation-title color_qty_{{$ode_detail->product_id}}">
                  {{-- Số lượng đặt --}}
                  <input class="btn-function-infomation quantity_order_{{$ode_detail->product_id}}" type="number" min="1" {{$get_status_show_btn_update_qty ==2 ? 'disabled' : ''}} value="{{$ode_detail->product_sales_quantity}}" name="product_sales_quantity">
                  {{-- Lấy số lượng trong kho  --}}
                  <input type="hidden" name="order_quantity" class="class_order_quantity_{{$ode_detail->product_id}}" value="{{$ode_detail->product->product_quantity}}">
                  {{-- Lấy mã đơn hàng --}}
                  <input type="hidden" name="order_code" class="class_order_code" value="{{$ode_detail->order_code}}">
                  {{-- Lấy id đơn hàng --}}
                  <input type="hidden" name="order_product_id" class="class_order_product_id" value="{{$ode_detail->product_id}}">
                  {{-- Lấy URL --}}
                  <input type="hidden" value="{{URL::to('')}}" name="url" class="form-control url" placeholder="url">
                  @if($get_status_show_btn_update_qty !=2)
                    <button class="btn-function-infomation update_quantity_order" data-product_id="{{$ode_detail->product_id}}" name="update_quantity">Cập nhật</button>
                  @endif
                    <p id="color_qty_text_{{$ode_detail->product_id}}"></p>
                </td>
                <td class="td-infomation-title color_qty_{{$ode_detail->product_id}}">{{number_format($ode_detail->product_price,0,',','.')}} VNĐ</td>
                <td class="td-infomation-title color_qty_{{$ode_detail->product_id}}">{{number_format($subtotal,0,',','.')}} VNĐ</td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <table class="tbl-function-infomation">
            <tr>
              <th class="td-infomation-title"><label class="lable-title">Tổng tiền tất cả:</label>
                <b class="text-danger">{{number_format($total,0,',','.')}} VNĐ </b>
              </th>
            </tr>
            <tr>
              <th class="td-infomation-title"><label class="lable-title">Phí Ship hàng:</label>
                <b class="text-danger">{{number_format($ode_detail->product_feeship,0,',','.')}} VNĐ </b><i class="text-warning">(Không áp dụng mã giảm giá(nếu có))</i>
              </th>
            </tr>
            <tr>
              <th class="td-infomation-title"><label class="lable-title">Mã giảm giá:</label>
                @if($ode_detail->product_coupon !='không có')
                @if($coupon_feature == 1)
                  <b class="text-success">{{$ode_detail->product_coupon}}</b><i class="text-danger">(Giảm @php echo $coupon_number; @endphp%)</i>
                @else
                  <b class="text-success">{{$ode_detail->product_coupon}}</b><i class="text-danger">(Giảm @php echo number_format($coupon_number,0,',','.'); @endphp VNĐ)</i>
                @endif
                @else
                  <b class="text-danger">Không có mã</b>  
                @endif
              </th>
            </tr>
            
            <tr>
              <th class="td-infomation-title"><label class="lable-title">Tổng giảm:</label>
                @php
                  $total_coupon = 0;
                @endphp
                @if($coupon_feature == 1)
                  @php
                    $total_after_coupon = ($total*$coupon_number)/100;
                    $total_coupon = $total - $total_after_coupon;
                    echo '<b class="text-success">'.number_format($total_after_coupon,0,',','.').' VNĐ</b>';
                  @endphp
                @else
                  @php
                    $total_coupon = $total - $coupon_number;
                    echo '<b class="text-success">'.number_format($coupon_number,0,',','.').' VNĐ</b>';
                  @endphp
                @endif
              </th>
            </tr>
            <tr>
              <th class="td-infomation-title">
                <label class="lable-title">Thành tiền:</label>
                <b class="text-primary">{{number_format($total_coupon+$ode_detail->product_feeship,0,',','.')}} VNĐ</b>
              </th>
            </tr>
            <tr>
         
            </tr>
          </table>
          
        </div>
      </div>
      <div class="container-fuild">
        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-7">
            <form>
              @csrf
              @foreach($order as $key => $ode_stt)
                  @if($ode_stt->order_status==2)
                    <select class="btn-function-infomation function_order_status">
                      <option id="{{$ode_stt->order_id}}" value="2"selected>Đã giao hàng-thanh toán</option>
                      <option id="{{$ode_stt->order_id}}" value="3">Hoàn tác-hủy giao hàng</option>
                    </select>
                  @elseif($ode_stt->order_status==3)
                    <select class="btn-function-infomation function_order_status">
                      <option id="{{$ode_stt->order_id}}" value="2">Đã giao hàng-thanh toán</option>
                      <option id="{{$ode_stt->order_id}}" value="3"selected>Hoàn tác-hủy giao hàng</option>
                    </select>  
                  @else                  
                    <select class="btn-function-infomation function_order_status">
                      <option id="{{$ode_stt->order_id}}" value="1" selected>Đã xem-đang xử lý</option>
                      <option id="{{$ode_stt->order_id}}" value="2">Đã giao hàng-thanh toán</option>
                    </select>
                  @endif
                @endforeach
              <a class="btn-function-infomation" href="{{url('/export-order/'.$ode_detail->order_code)}}">Xuất đơn hàng</a>  
            </form>
          </div>
          <div class="col-sm-6"></div>
        </div>
      </div>
      <br>
      
    </div>
  </div>
 
</div>
@endsection
@section('script')
{{-- <script src="{{asset('public/ajax/dashboard/filter.js')}}"></script> --}}
{{-- <script src="{{asset('public/ajax/dashboard/auto_complete.js')}}"></script> --}}
<script src="{{asset('public/ajax/dashboard/order.js')}}"></script>
@endsection