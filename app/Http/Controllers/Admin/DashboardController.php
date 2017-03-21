<?php

namespace App\Http\Controllers\Admin;

use App\Avatar;
use App\Frame;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $page_title = 'Bảng Điều Khiển';
        $photo_created = Avatar::count();
        $frame_uploaded = Frame::count();
        return view( 'admin.dashboard', compact( 'page_title', 'photo_created', 'frame_uploaded' ) );
    }
}
