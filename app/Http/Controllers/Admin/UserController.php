<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        $page_title = 'Quản Lý Người Dùng';
        return view( 'admin.user-list', compact( 'page_title' ) );
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
            $args[] = ['name', 'LIKE', '%'. $search .'%'];
        }

        // Sort
        $col_name  = 'name';
        $direction = 'desc';
        if( isset( $order[0]['column'] )  ) {
            $col_name  = $columns[ $order[0]['column'] ]['data'];
            $direction = ! empty( $order[0]['dir'] ) ? $order[0]['dir'] : 'asc';
        }

        $users = User::where( $where_args )->orderBy( $col_name, $direction )->take( $length )->get();

        // Output
        $total  = User::count();
        $filter = $users->count();
        $data   = $users->toArray();

        return response()->json([
            'draw'            => $req->draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $filter,
            'data'            => $data,
        ]);
    }

    public function showFormAdd(){
        $page_title = 'Thêm Người Dùng';
        return view( 'admin.user-add', compact( 'page_title' ) );
    }

    public function create(Request $req){
        $this->validate($req, [
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users,email|max:255',
            'password'  => 'required|min:6|max:255|confirmed',
        ]);
        $user = new User;
        $user->fill([
            'name'     => $req->name,
            'email'    => $req->email,
            'password' => bcrypt( $req->password )
        ]);
        $user->save();
        return redirect( 'admin/user' )->with( 'message', 'Thêm người dùng thành công!' );
    }

    public function showFormEdit( $id ){
        $page_title = 'Sửa Thông Tin Người Dùng';
        $user = User::findOrFail( $id );
        return view( 'admin.user-edit', compact( 'page_title', 'user' ) );
    }

    public function update( $id, Request $req ){
        $this->validate($req, [
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users,email,'.intval( $id ).'|max:255',
            'password'  => 'present|min:6|max:255|confirmed',
        ]);
        $user = User::findOrFail( $id );
        $user->name = $req->name;
        $user->email = $req->email;
        if( !empty( $req->password ) ) {
            $user->password = bcrypt( $req->password );
        }
        $user->save();
        return redirect( 'admin/user' )->with( 'message', 'Sửa thông tin người dùng thành công!' );
    }

    public function delete( $id ) {
        if( $id == 1 ) {
            return abort('403');
        }
        $user = User::findOrFail( $id );
        $user->delete();
        return redirect( 'admin/user' )->with( 'message', 'Xóa người dùng thành công!' );
    }

}
