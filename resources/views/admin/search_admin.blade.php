<div class="card">
    <div class="card-body">
      <table class="tbl-function-infomation">
        <thead>
          <tr>
            <th class="th-infomation-title" style="width:4.8%;">
              STT
            </th>
            <th class="th-infomation-title" style="width:15%;">Tên quản trị viên</th>
            <th class="th-infomation-title" style="width:8.5%;">Hình ảnh</th>
            <th class="th-infomation-title" style="width:27%;">Email</th>
            <th class="th-infomation-title" style="width:20%;">Số điện thoại</th>
            <th class="th-infomation-title" style="width:10%;">Cấp bậc</th>
            <th class="th-infomation-title" style="width:13.2%;">Chức năng</th>
          </tr>
        </thead>
        <tbody>
         
          @foreach($all_admin as $key => $ad)
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
            <td class="td-infomation-title">{{ $ad->admin_email }}</td>
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
              <a href="{{URL::to('/edit-admin/'.$ad->admin_id)}}" class="edit-delete-function" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>Chi tiết</a>
                
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>