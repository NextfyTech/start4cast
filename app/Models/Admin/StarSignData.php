<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarSignData extends Model
{
    protected $table = 'horosco_startsign_data';
    protected $fillable = ['data_id','starsign_id','date_from','date_to','data_type','data_txt','data_added_date','data_from_file'];
    use HasFactory;
}
