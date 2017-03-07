<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function index(){
        $page_title = 'Tài Khoản Của Tôi';
        return view( 'admin.account', compact( 'page_title' ) );
    }

    public function save(Request $req){
        $this->validate($req, [
            'name'        => 'required|max:255',
            'password'    => 'max:255',
            'newpassword' => 'max:255',
        ]);
        $me = User::find( auth()->user()->id );
        if( Hash::check( $req->password, auth()->user()->password ) && !empty( $req->newpassword ) ) {
            $me->password = bcrypt( $req->newpassword );
            auth()->logout();
        }
        $me->name = $req->name;
        $me->save();
        return redirect('admin/account')->with( 'message', 'Lưu thành công!' );
    }
}
