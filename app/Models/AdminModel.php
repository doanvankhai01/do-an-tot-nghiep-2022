<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;//User là cố định, ko sửa
use Illuminate\Database\Eloquent\Model;
use App\Models\RolesModel;
class AdminModel extends Authenticatable
{
    public $timestamps = false;//set time to false
    protected $fillable =[
        'admin_email',
        'admin_password',
        'admin_name',
        'admin_slug',
        'admin_birdthday',
        'admin_address',
        'admin_image',
        'admin_phone',
        'admin_status',
        'waste_basket_admin',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';
    
    public function roles(){
        return $this->belongsToMany('App\Models\RolesModel');
    }

    public function getAuthPassword(){//Tên hàm cố định không đc sửa
        return $this->admin_password;
    }
    public function hasAnyRoles($roles){
        return null !== $this->roles()->whereIn('roles_name', $roles)->first();
        //WHERE IN có tác dụng tương tự như hàm in_array() trong PHP vậy, nghĩa là sẽ kiểm tra giá trị của field đó có nằm trong một tập hợp nào đó hay không.
    }
    public function hasRoles($role){
        return null !== $this->roles()->where('roles_name', $role)->first();
    }
}
