<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable =[
        'product_name','product_slug','product_quantity','product_quantity_sold','category_id','brand_id','product_desc','product_content','product_price','product_image','product_status','waste_basket_product'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
    //
    public function category_model(){
        return $this->belongsTo('App\Models\CategoryModel','category_id');
        //belongsTo ở đây nghĩa là product thuộc về category
        // belongsTo và hasMany cũng tựa tựa như join trong DB
    }
    public function brand_model(){
        return $this->belongsTo('App\Models\BrandModel','brand_id');
    }
}
