<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeShipModel extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable =[
        'province_id','district_id','town_id','freeship_number'
    ];
    protected $primaryKey = 'feeship_id';
    protected $table = 'tbl_feeship';

    public function province_model(){
        return $this->belongsTo('App\Models\ProvinceModel','province_id');
    }
    public function district_model(){
        return $this->belongsTo('App\Models\DistrictModel','district_id');
    }
    public function town_model(){
        return $this->belongsTo('App\Models\TownModel','town_id');
    }
}
