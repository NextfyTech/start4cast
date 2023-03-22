<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dailyController extends Controller
{
    public function index()
    {
        return view('admin.Data_Manager.daily');
    }
}
