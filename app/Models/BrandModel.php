<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable =[
        'brand_name','brand_slug','brand_desc','brand_status','created_at','updated_at'
    ];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand';

    public function product_model(){
        return $this->hasMany('App\Models\Product','brand_id');
        //hasMany có nghĩa là một brand có nhiều product
    }
}
