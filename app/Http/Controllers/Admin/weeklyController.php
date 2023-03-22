<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class weeklyController extends Controller
{
    public function index()
    {
        return view('admin.Data_Manager.weekly');
    }
}
