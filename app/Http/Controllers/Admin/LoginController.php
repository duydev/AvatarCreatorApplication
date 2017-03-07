<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'admin';

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware( 'guest', ['except' => 'logout'] );
    }

    public function showLoginForm()
    {
        return view( 'admin.login' );
    }


}
