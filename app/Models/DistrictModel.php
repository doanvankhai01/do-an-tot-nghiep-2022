<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictModel extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable =[
        'district_name','district_type','province_id'
    ];
    protected $primaryKey = 'district_id';
    protected $table = 'tbl_district';
}
