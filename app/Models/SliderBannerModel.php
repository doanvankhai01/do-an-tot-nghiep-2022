<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderBannerModel extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable =[
        'slider_name','slider_slug','slider_image','slider_status','slider_desc','waste_basket_slider'
    ];
    protected $primaryKey = 'slider_id';
    protected $table = 'tbl_slider';
}
