<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdminModel;
class RolesModel extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable =[
        'roles_name'
    ];
    protected $primaryKey = 'roles_id';
    protected $table = 'tbl_roles';

    public function admin(){
        return $this->belongsToMaNy('AdminModel');
    }
}
