<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinceModel extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable =[
        'province_name','province_type'
    ];
    protected $primaryKey = 'province_id';
    protected $table = 'tbl_province';
}
