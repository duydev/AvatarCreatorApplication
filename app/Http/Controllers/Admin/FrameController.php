<?php

namespace App\Http\Controllers\Admin;

use App\Frame;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FrameController extends Controller
{
    public function index() {
        $page_title = 'Danh Sách Khung';
        return view( 'admin.frame-list', compact( 'page_title' ) );
    }

    public function showFormAdd(){
        $page_title = 'Thêm Khung';
        return view( 'admin.frame-add', compact( 'page_title' ) );
    }

    public function create(Request $req){
        $this->validate($req, [
            'title'  => 'required|max:255',
            'image'   => 'required|max:3000|image',
        ]);
        $image = $req->image;
        $frame = new Frame;
        $frame->fill([
            'user_id' => auth()->user()->id,
            'title'   => $req->title,
            'url'     => '',
            'width'   => 0,
            'height'  => 0
        ]);
        $frame->save();
        $filename = sprintf( 'khung-%1$d.%2$s', $frame->id, $image->extension() );
        $path = $image->storeAs( 'uploads', $filename );
        list($width, $height) = getimagesize( $path );
        $frame->url = asset( $path );
        $frame->width = $width;
        $frame->height = $height;
        $frame->save();
        return redirect( 'admin/frame' )->with( 'message', 'Thêm khung thành công!' );
    }

    public function listProcess(Request $req){
        // Input
        $length  = ! empty( $req->length ) ? intval( $req->length ) : 10;
        $search  = ! empty( $req->search['value'] ) ? $req->search['value'] : '';
        $columns = ! empty( $req->columns ) ? $req->columns : array();
        $order   = ! empty( $req->order ) ? $req->order : array();

        // Process

        // Search
        $where_args = [];
        if( $search )
        {
            $args[] = ['title', 'LIKE', '%'. $search .'%'];
        }

        // Sort
        $col_name  = 'title';
        $direction = 'desc';
        if( isset( $order[0]['column'] )  ) {
            $col_name  = $columns[ $order[0]['column'] ]['data'];
            $direction = ! empty( $order[0]['dir'] ) ? $order[0]['dir'] : 'asc';
        }

        $frames = Frame::where( $where_args )->orderBy( $col_name, $direction )->take( $length )->with( 'user' )->get();

        // Output
        $total  = Frame::count();
        $filter = $frames->count();
        $data   = $frames->toArray();

        return response()->json([
            'draw'            => $req->draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $filter,
            'data'            => $data,
        ]);
    }

    public function showFormEdit( $id ){
        $page_title = 'Sửa Khung';
        $frame = Frame::findOrFail( $id );
        return view( 'admin.frame-edit', compact( 'page_title', 'frame' ) );
    }

    public function update( $id, Request $req ){
        $this->validate($req, [
            'title'  => 'required|max:255',
            'image'  => 'max:3000|image',
        ]);
        $frame = Frame::findOrFail( $id );
        $frame->title = $req->title;
        $image = $req->image;
        if( !empty( $image ) ) {
            $filename = sprintf( 'khung-%1$d.%2$s', $frame->id, $image->extension() );
            if( Storage::disk('_public')->has( 'uploads/'.$filename ) ) {
                Storage::disk('_public')->delete( 'uploads/'.$filename );
            }
            $path = $image->storeAs( 'uploads', $filename );
            list($width, $height) = getimagesize( public_path( '../'. $path ) );
            $frame->url = asset( $path );
            $frame->width = $width;
            $frame->height = $height;
        }
        $frame->save();
        return redirect( 'admin/frame' )->with( 'message', 'Sửa khung thành công!' );
    }

    public function delete( $id ) {
        $frame = Frame::findOrFail( $id );
        $frame_path = basename( $frame->url );
        if( !empty( $frame_path ) ) {
            Storage::disk('_public')->delete( 'uploads/'. $frame_path );
        }
        $frame->delete();
        return redirect( 'admin/frame' )->with( 'message', 'Xóa khung thành công!' );
    }
}
