<?php

namespace App\Http\Controllers\Admin;

use App\Avatar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvatarController extends Controller
{
    public function index() {
        $page_title = 'Xem Avatar Đã Tạo';
        return view( 'admin.avatar', compact( 'page_title' ) );
    }

    public function listProcess(Request $req){
        // Input
        $start   = ! empty( $req->start )   ? intval( $req->start )  : 0;
        $length  = ! empty( $req->length )  ? intval( $req->length ) : 10;
        $columns = ! empty( $req->columns ) ? $req->columns          : array();
        $order   = ! empty( $req->order )   ? $req->order            : array();

        // Process

        // Sort
        $col_name  = $direction = '';
        if( isset( $order[0]['column'] )  ) {
            $col_name  = $columns[ $order[0]['column'] ]['data'];
            $direction = ! empty( $order[0]['dir'] ) ? $order[0]['dir'] : 'asc';
        }

        $frames = Avatar::orderBy( $col_name, $direction )->skip( $start )->take( $length )->get();

        // Output
        $total  = Avatar::count();
        $filter = $total;
        $data   = $frames->toArray();

        return response()->json([
            'draw'            => $req->draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $filter,
            'data'            => $data,
        ]);
    }
}
