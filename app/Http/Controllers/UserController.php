<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
class UserController extends Controller
{
    public function index(){
        $admin = AdminModel::with('roles')->orderBy('admin_status','ASC')->paginate(5);
        //with('roles') là gọi hàm roles() đã được khởi tạo trong AdminModel
        return view('admin.users.all_users')
        ->with(compact('admin'))
        ->with('i',(request()->input('page',1)-1)*5);
    }
}
