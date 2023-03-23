<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarSignData extends Model
{
    protected $table = 'horosco_startsign_data';
    protected $fillable = ['date_from'];
    use HasFactory;
}
