<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $page_title = 'Bảng Điều Khiển';
        return view( 'admin.dashboard', compact( 'page_title' ) );
    }
}
