<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TownModel extends Model
{
    public $timestamps = false;//set time to false
    protected $fillable =[
        'town_name','town_type','district_id'
    ];
    protected $primaryKey = 'town_id';
    protected $table = 'tbl_town';
}
