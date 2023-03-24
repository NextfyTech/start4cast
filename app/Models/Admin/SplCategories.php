<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SplCategories extends Model
{
    protected $table = 'horosco_spl_categories';
    use HasFactory;
    protected $guarded = [];
}
