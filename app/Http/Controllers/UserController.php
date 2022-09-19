<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Models\RolesModel;
class UserController extends Controller
{
    //Hiển thị danh sách Auth
    public function index(){
        $admin = AdminModel::with('roles')->orderBy('admin_status','ASC')->paginate(5);
        //with('roles') là gọi hàm roles() đã được khởi tạo trong AdminModel
        return view('admin.users.all_users')
        ->with(compact('admin'))
        ->with('i',(request()->input('page',1)-1)*5);
    }
    //Thêm Auth
    public function  add_roles_auth(){

    }
    //phân quyền
    public function assign_roles(Request $request){
        $data = $request->all();
        $admin  = AdminModel::where('admin_email',$data['admin_email'])->first();
        //kiểm tra email gửi qua có khớp với cơ sở dữ liệu hay không , nếu khớp thì lấy ra 1 giá trị duy nhẩt
        $admin->roles()->detach();
        //roles() : quyền  
        /*
            1. attach
            Phương thức trợ giúp cụ thể này có thể được sử dụng để đính kèm một bản ghi thực thể nhất định vào bản ghi thực thể khác trong bảng tổng hợp. Ví dụ: trong ví dụ trên, nếu chúng ta muốn đính kèm một tác giả vào một cuốn sách, chúng ta có thể sử dụng attachphương thức sẽ chèn một bản ghi có liên quan vào bảng tổng hợp / trung gian như sau:

            $book = App\Book::find(1);

            $book->authors()->attach($authorId);
      
            Bạn cũng có thể chuyển dữ liệu bổ sung trong attachphương thức nếu bạn muốn cập nhật các trường bổ sung trong bảng trung gian.

            $book = App\Book::find(1);

            $book->authors()->attach($authorId, ['best_seller' => true]);
     
            2. detach
            Tương tự, nếu bạn muốn xóa một mối quan hệ thực thể nhất định khỏi bảng tổng hợp, bạn có thể sử dụng detachphương thức. Ví dụ: nếu bạn muốn xóa một tác giả nào đó khỏi một cuốn sách, bạn có thể làm như vậy.

            $book->authors()->detach($authorId);
     
            Hoặc bạn có thể chuyển nhiều ID dưới dạng một mảng.

            $book->authors()->detach([4, 5, 8]);
            Nếu bạn muốn xóa tất cả các tác giả khỏi sách, hãy sử dụng detachmà không chuyển bất kỳ đối số nào.

            $book->authors()->detach();
        */
        if($request['select_roles']){
            $admin->roles()->attach(RolesModel::where('roles_name','select')->first());
        }
        if($request['insert_roles']){
            $admin->roles()->attach(RolesModel::where('roles_name','insert')->first());
        }
        if($request['update_roles']){
            $admin->roles()->attach(RolesModel::where('roles_name','update')->first());
        }
        if($request['delete_roles']){
            $admin->roles()->attach(RolesModel::where('roles_name','delete')->first());
        }
        return redirect()->back();
        
    }
}
