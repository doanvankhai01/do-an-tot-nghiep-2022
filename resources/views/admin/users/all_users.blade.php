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
<div class="table-agile-info" id="">
  <div class="panel panel-default" >
    <div class="panel-heading">
      <h2 class="h2-title">Liệt kê danh sách quản trị viên</h2>
    </div>
    <div class="row">
      <div class="col-sm-2">
        
        <form action="{{URL::to('/add-admin')}}">
          <button class="btn-function-infomation" id="">
            <i class="fa fa-plus"></i>
            Thêm thành viên
          </button>
        </form>
      </div>
      <div class="col-sm-5">
        {{-- <form >
          @csrf
          <select name="sort" id="sort" class="btn-function-infomation">
              <option value="{{Request::url()}}?sort_by=none">--- Lọc theo ---</option>
              <option value="{{Request::url()}}?sort_by=tang_dan">Lọc theo giá từ nhỏ nhất đên lớn nhất</option>
              <option value="{{Request::url()}}?sort_by=giam_dan">Lọc theo giá từ lớn nhất đên nhỏ nhất</option>
              <option value="{{Request::url()}}?sort_by=a_den_z">Lọc theo tên từ A đến Z</option>
              <option value="{{Request::url()}}?sort_by=z_den_a">Lọc theo tên từ Z đến A</option>
          </select>
          <p></p>
        </form>             --}}
      </div>
      <div class="col-sm-2">
      </div>
      <div class="col-sm-3">
        <div class="">
          <form>
            @csrf
            <div class="search_box pull-right">
              <input type="text" class="btn-function-infomation search_admin_name" name="search_admin_submit" id="keywords_admin" placeholder="Nhập tên admin">
              <input class="btn-function-infomation search_admin" name="search_items" type="button" value="Tìm kiếm">
            </div>
            <div class="div-auto-complete-search search_admin_ajax" style="" id="search_admin_ajax"></div>
        </form>
        </div>
      </div>
      
    </div>
    <div class="">
      <a class="link-href-admin" href="{{URL::to('/dashboard')}}">Trang chủ</a>/
      <a  class="link-href-admin" href="">Tài khoản</a>
    </div>
    <div class="table-responsive" id="show_search_admin">
      <div class="card">
        <div class="card-body">
          <table class="tbl-function-infomation">
            <thead>
              <tr>
                <th class="th-infomation-title" style="width:4.8%;">
                  STT
                </th>
                <th class="th-infomation-title" >Tên quản trị viên</th>
                <th class="th-infomation-title" >Hình ảnh</th>
                <th class="th-infomation-title" >Email</th>
                <th class="th-infomation-title" >Số điện thoại</th>
                <th class="th-infomation-title" >Cấp bậc</th>
                <th class="th-infomation-title" >Xem</th>
                <th class="th-infomation-title" >Thêm</th>
                <th class="th-infomation-title" >Sửa</th>
                <th class="th-infomation-title" >Xóa</th>
                <th class="th-infomation-title" >Phân quyền</th>
                <th class="th-infomation-title" >Chức năng</th>
              </tr>
            </thead>
            <tbody>
              
                @foreach($admin as $key => $ad)
                <form action="{{url('/assign-roles')}}" method="POST">
                  @csrf
                  <tr>
                    <td class="td-infomation-title">{{$i++ + 1;}}
                    {{-- 
                      ++i tăng giá trị của i lên 1 và trả về giá trị mới đó.
                      i++ cũng tương tự nhưng giá trị trả về là giá trị ban đầu của i trước khi được tăng lên 1. 
                      =>Phân tích: i++ thì lấy từ 0 , tức là nếu cho i bằng 0 thì sẽ lấy giá trị khởi đầu là 0
                      nếu ++i thì bỏ qua giá trị khởi đầu 0, và lấy giá trị khởi đầu là 1 
                      tức là dễ hiểu nhất : i++ + 1 = ++i(hiểu theo cách lấy sô thứ tự tăng dần)
                    --}}
                    </td>
                    <td class="td-infomation-title">{{ $ad->admin_name }}</td>
                    <td class="td-infomation-title"><img src="public/uploads/admin/{{$ad->admin_image}}" height="100" width="100"></td>
                    <td class="td-infomation-title">
                      {{ $ad->admin_email }}
                      <input type="hidden" name="admin_email" value="{{$ad->admin_email}}">
                    </td>
                    <td class="td-infomation-title">{{ $ad->admin_phone }}</td>
                    <td class="td-infomation-title">
                    @if ($ad->admin_status == 0)
                        <p class="text-danger">Giám đốc</p>
                    @elseif($ad->admin_status == 1)
                        <p class="text-info">Quản lý</p>
                    @else
                        <p class="">Nhân viên</p>
                    @endif
                    </td>
                    <td class="td-infomation-title">
                      <input type="checkbox" name="select_roles"{{$ad -> hasRoles('select') ? 'checked' : ''}}>
                      {{-- 
                      ?(Nếu hasRole là select) thì checked :(Nếu ko) thì trống 
                      --}}
                    </td>
                    <td class="td-infomation-title">
                      <input type="checkbox" name="insert_roles"{{$ad -> hasRoles('insert') ? 'checked' : ''}}>
                      {{-- 
                      ?(Nếu hasRole là insert) thì checked :(Nếu ko) thì trống 
                      --}}
                    </td>
                    <td class="td-infomation-title">
                      <input type="checkbox" name="update_roles"{{$ad -> hasRoles('update') ? 'checked' : ''}}>
                      {{-- 
                      ?(Nếu hasRole là update) thì checked :(Nếu ko) thì trống 
                      --}}
                    </td>
                    <td class="td-infomation-title">
                      <input type="checkbox" name="delete_roles"{{$ad -> hasRoles('delete') ? 'checked' : ''}}>
                      {{-- 
                      ?(Nếu hasRole là delete) thì checked :(Nếu ko) thì trống 
                      --}}
                    </td>
                    <td>
                      <input type ="submit" value="Phân quyền">
                    </td>
                  </form>
                    <td class="td-infomation-title">
                        <?php
                          $message = Session::get("admin_status");
                          if($message == 0 || $message ==1){         
                        ?>
                          {{-- <a href="{{URL::to('/edit-admin/'.$ad->admin_id)}}" class="edit-delete-function" ui-toggle-class="">
                          <i class="fa fa-pencil-square-o text-success text-active"></i>Chi tiết</a> --}}
                          <a>
                          <button class="edit-delete-function edit_admin" value="edit" ui-toggle-class="" data-admin_id ="{{$ad->admin_id}}">
                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                            <b>Chi tiết</b>
                          </button>
                        <?php
                        }
                        ?>
                        <?php
                          $message = Session::get("admin_status");
                          if($message == 0){         
                        ?>
                          <button class="edit-delete-function delete_admin" value="delete" ui-toggle-class="" data-admin_id ="{{$ad->admin_id}}">
                            <i class="material-icons text-danger">delete_forever</i>
                            <b>Xóa</b>
                          </button>
                        <?php
                        }
                        ?>
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

          {{$admin->links()}}  
          {{-- links gọi các nút phân trang, chuyển trang và để định dạng cho đẹp thì vào App\Providers\AppServiceProvider để định dạng kiểu nút phân trang cho đẹp--}}
      </div>
      
    </footer>
  </div>
</div>
@endsection
@section('script')
{{-- <script src="{{asset('public/ajax/dashboard/admin.js')}}"></script> --}}
@endsection