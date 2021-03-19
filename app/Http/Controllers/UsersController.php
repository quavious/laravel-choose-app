<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }


    public function confirm(Request $request)
    {
        # code...
        return view("users.delete");
    }

    public function delete(Request $request)
    {
        # code...
        $value = $request->validate([
            "password" => "required",
        ]);
        $flag = Hash::check($value["password"], auth()->user()->password);
        if (!$flag) {
            return back()->withErrors(["비밀번호가 맞지 않습니다."]);
        } else {
            $request->user()->delete();
            return redirect()->route("index");
        }
    }
}
