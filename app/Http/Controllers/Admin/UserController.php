<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(20);

        return admin_view('user.index',compact('users'));
    }
}