<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdminModel;
class RolesModel extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable =[
        'role_name'
    ];
    protected $primaryKey = 'role_id';
    protected $table = 'tbl_role';

    public function admin(){
        return $this->belongsToMaNy('AdminModel');
    }
}
