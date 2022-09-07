<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
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
}
