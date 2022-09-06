<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorModel extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable =[
        'visitor_id','ip_address'
    ];
    protected $primaryKey = 'visitor_id';
    protected $table = 'tbl_visitor';
}
