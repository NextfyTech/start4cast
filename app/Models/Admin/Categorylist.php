<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorylist extends Model
{
    use HasFactory;
    protected $table='horosco_spl_categories';
   protected $fillable=['spl_category_id','spl_category'];
}
