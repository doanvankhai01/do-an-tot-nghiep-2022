<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AdminModel;
use App\Models\RolesModel;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // AdminModel::truncate();//Xóa toàn bộ dữ liệu trong admin
        // DB::table('admin_roles')->truncate();
        // $roles_select = RolesModel::where('name','select')->take(1)->get();
        //take(1) là lấy 1 thằng đầu tiên trong dữ liệu lấy được
        $roles_select = RolesModel::where('roles_name','select')->first();//Lấy dữ liệu trong Roles
        $roles_insert = RolesModel::where('roles_name','insert')->first();//lấy dữ liệu trong Roles
        $roles_update = RolesModel::where('roles_name','update')->first();//lấy dữ liệu trong Roles
        $roles_delete = RolesModel::where('roles_name','delete')->first();//lấy dữ liệu trong Roles

        $select = AdminModel::create([
            'admin_email' => 'adminselect@gmail.com',
            'admin_password' => md5('123456'),
            'admin_name' => 'Đoàn Văn Khai Select',
            'admin_slug' => 'doan-van-khai-select',
            'admin_birdthday' => '12-12-1221',
            'admin_address' => 'Huế',
            'admin_image' => 'tải xuống359295.jfif',
            'admin_phone' => '0873689764',
            'admin_status' => '0',
            'waste_basket_admin' => '0',
        ]);
        $insert = AdminModel::create([
            'admin_email' => 'admininsert@gmail.com',
            'admin_password' => md5('123456'),
            'admin_name' => 'Đoàn Văn Khai Insert',
            'admin_slug' => 'doan-van-khai-insert',
            'admin_birdthday' => '12-12-1221',
            'admin_address' => 'Huế',
            'admin_image' => 'tải xuống359295.jfif',
            'admin_phone' => '0873689764',
            'admin_status' => '0',
            'waste_basket_admin' => '0',
        ]);
        $update = AdminModel::create([
            'admin_email' => 'adminupdate@gmail.com',
            'admin_password' => md5('123456'),
            'admin_name' => 'Đoàn Văn Khai Update',
            'admin_slug' => 'doan-van-khai-update',
            'admin_birdthday' => '12-12-1221',
            'admin_address' => 'Huế',
            'admin_image' => 'tải xuống359295.jfif',
            'admin_phone' => '0873689764',
            'admin_status' => '0',
            'waste_basket_admin' => '0',
        ]);
        $delete = AdminModel::create([
            'admin_email' => 'admindelete@gmail.com',
            'admin_password' => md5('123456'),
            'admin_name' => 'Đoàn Văn Khai Delete',
            'admin_slug' => 'doan-van-khai-delete',
            'admin_birdthday' => '12-12-1221',
            'admin_address' => 'Huế',
            'admin_image' => 'tải xuống359295.jfif',
            'admin_phone' => '0873689764',
            'admin_status' => '0',
            'waste_basket_admin' => '0',
        ]);


        $select->roles()->attach($roles_select);
        $insert->roles()->attach($roles_insert);
        $update->roles()->attach($roles_update);
        $delete->roles()->attach($roles_delete);

        //roles() : hàm được khởi tạo trong admin model
        //attach() : đính kèm dữ liệu,Đính kèm được sử dụng chủ yếu Mối quan hệ hùng hồn trong nhiều mối quan hệ . Nó chủ yếu sử dụng chèn hoặc cập nhật dữ liệu bảng trung gian. Ví dụ, hãy tưởng tượng một người dùng có thể có nhiều vai trò và một vai trò có thể có nhiều người dùng. Bạn có thể sử dụng phương thức đính kèm để đính kèm vai trò cho người dùng bằng cách chèn bản ghi vào bảng trung gian của mối quan hệ:
    
        // factory(App\Models\AdminModel::class,20)->create();
        // Ý nghĩa câu lệnh: tạo dữ liệu, xong kết nối tới model gọi function roles() liên kết với RolesModel . 
        // Sau đó hàm attach() khởi tạo vào bảng mới(dựa trên tên 2 model liên kết với nhau để đặt tên cho bẳng mới) kèm kết nối id phân quyền.
        // 
    }
}
