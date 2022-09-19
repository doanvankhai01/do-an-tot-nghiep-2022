<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RolesModel;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // 
    public function run()
    {
        RolesModel::truncate();//Khi phát hiện dữ liệu thì sẽ xóa hết dữ liệu trong bảng đó

        RolesModel::create(['roles_name' => 'insert']);//Thêm dữ liệu mới vào bảng
        RolesModel::create(['roles_name' => 'select']);//Thêm dữ liệu mới vào bảng
        RolesModel::create(['roles_name' => 'update']);//Thêm dữ liệu mới vào bảng
        RolesModel::create(['roles_name' => 'delete']);//Thêm dữ liệu mới vào bảng
    }
}
