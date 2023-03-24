<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SplData extends Model
{
    protected $table = 'horosco_spl_data';
    use HasFactory;

    protected $guarded = [];
}
