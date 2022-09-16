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
        return $this->belongsToMany('RolesModel');
    }

    public function getAuthPassword(){//Tên hàm cố định không đc sửa
        return $this->admin_password;
    }
}
