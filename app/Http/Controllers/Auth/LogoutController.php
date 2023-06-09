<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
    public function logout(){
        Auth::logout();
        return view("auth.login");
        }
    }