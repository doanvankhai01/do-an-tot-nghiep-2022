@extends('admin.admin_layout')
@section('admin_content')

<section class="section">
    <div class="section-header">
        <h2 class="h2-title">Mã giảm giá</h2>
        <div class="row">
            <div class="col-sm-2">
                <form action="{{URL::to('/add-coupon')}}">
                    <button class="btn-function-infomation" id="">
                        <i class="fa fa-plus"></i>
                        Thêm mã giảm giá
                    </button>
                </form>
            </div>
            <div class="col-sm-5">
                <select class="btn-function-infomation">>
                  <option value="0">Bulk action</option>
                  <option value="1">Delete selected</option>
                  <option value="2">Bulk edit</option>
                  <option value="3">Export</option>
                </select>
                <button class="btn-function-infomation">Apply</button>                
              </div>
              <div class="col-sm-2">
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
            <a  class="link-href-admin" href="">Mã giảm giá</a>
          </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="tbl-function-infomation">
                                <thead>
                                    <tr>
                                        <th class="th-infomation-title">Tên mã giảm giá</th>
                                        <th class="th-infomation-title">Mã giảm giá</th>
                                        <th class="th-infomation-title">Số lượng mã</th>
                                        <th class="th-infomation-title">Giảm theo tiền/%</th>
                                        <th class="th-infomation-title">Số tiền/số phần trăm giảm</th>
                                        <th class="th-infomation-title" style="width:10%;">Quản lý</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupon_model as $key => $cou)
                                    <tr>
                                        <td class="td-infomation-title">{{$cou->coupon_name}}</td>
                                        <td class="td-infomation-title">{{$cou->coupon_code}}</td>
                                        <td class="td-infomation-title">{{$cou->coupon_time}}</td>
                                        <td class="td-infomation-title">
                                            <?php
                                                if($cou->coupon_feature==1){
                                                ?>
                                                Giảm theo %
                                                <?php
                                                }else{
                                                ?>
                                                Giảm theo tiền
                                                <?php
                                                }
                                            ?>
                                        </td>
                                        <td class="td-infomation-title">
                                            <?php
                                                if($cou->coupon_feature==1){
                                                ?>
                                                Giảm {{$cou->coupon_number}} %
                                                <?php
                                                }else{
                                                ?>
                                                Giảm {{$cou->coupon_number}} VNĐ
                                                <?php
                                                }
                                            ?>
                                        </td>
                                        <td class="td-infomation-title" style="text-align:center;">
                                            <a onclick="return confirm('Bạn có muốn xóa sản phẩm, sản phẩm sẽ được lưu trữ trong thùng rác?')"  href="{{URL::to('/unactive-waste-basket-coupon/'.$cou->coupon_id)}}" class="edit-delete-function" ui-toggle-class="">
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
                </div>
                <footer class="panel-footer">
                    <div class="product-paginate"> 
                        {{$coupon_model->links()}}  
                        {{-- links gọi các nút phân trang, chuyển trang và để định dạng cho đẹp thì vào App\Providers\AppServiceProvider để định dạng kiểu nút phân trang cho đẹp--}}
                    
                    </div>
                  </footer>
            </div>
        </div>
    </div>
</section>

@endsection