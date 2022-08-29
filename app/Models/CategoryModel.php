<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable =[
        'category_name','category_slug','category_desc','category_status','waste_basket_category','created_at','updated_at'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';

    public function product_model(){
        return $this->hasMany('App\Models\Product','category_id');
        //hasMany có nghĩa là một categoty có nhiều product
    }
}
