<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    function showProfile(){
        return view('frontend.profile.show_profile');
    }

    function updateProfile(Request $request){

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' .Auth::user()->id,
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        
        if ($user->update($request->all())){
            return back()->with('success', 'Profile update successfully');
        }else{
            return back()->with('error', 'Profile could not be update');
        }
    }

    function changePassword(Request $request){
        return view('frontend.auth.passwords.change_password');
    }

    function updatePassword(Request $request){

        $this->validate($request, [
            'password' => 'required|min:6|string|confirmed'
        ]);

        $data = [];
        $data['password'] =  Hash::make($request->password);

        $update_password = User::where('id', Auth::user()->id)
            ->update($data);

        if ($update_password){
            return back()->with('success', 'Password update successfully');
        }else{
            return back()->with('error', 'Profile could not be update');
        }
    }
}
