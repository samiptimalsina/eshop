<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Component\fileHandlerComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Log;
use Validator;

class UsersController extends Controller
{
    public $fileHandler;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->fileHandler = new fileHandlerComponent();
    }

    function showProfile(){
        return view('frontend.profile.show_profile');
    }

    function getProfileInfo(){
        $user = User::where('id', Auth::user()->id)->first();
        return $user;
    }

    function updateProfile(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'numeric|unique:users,phone,'. Auth::user()->id,
            'email' => 'required|email|unique:users,email,'. Auth::user()->id,
            'date_of_birth' => 'date',
        ],
        [
            'phone.numeric' => 'Invalid phone number',
            'date_of_birth.date' => 'Invalid birth date',
        ]);

        if ($validator->fails())
        {
            return ['errors' => $validator->errors()->first()];
            //return response()->json(['errors'=>$validator->errors()->first()]);
        }

        $user = User::where('id', Auth::user()->id)->first();

        if ($user->update($request->except(['image', 'created_at', 'updated_at']))){
            return ['success'=>'Update successfully'];
        }else{
            return ['errors'=>'Could not be update'];
        }
    }

    function imageUpload(Request $request){

        $validator = Validator::make($request->all(), [
            'img' => 'required|image|mimes:jpg,jpeg,bmp,png|max:1024',
        ],
        [
            'img.uploaded' => 'Can not save image. Maximum 1MB',
            'img.required' => 'Please Choose An Image First'
        ]);

        if ($validator->fails())
        {
            return ['errors' => $validator->errors()->first()];
        }

        $user = User::where('id', Auth::user()->id)->first();

        if ($request->img){
            $image_name = $this->fileHandler->imageUpload($request->file('img'), 'img');

            if ($image_name){
                $request['image'] = $image_name;
            }

            //Delete old image
            if ($user->image){
                $this->fileHandler->deleteImage($user->image);
            }
        }

        $update = $user->update($request->all());

        if ($update){
            return ['success'=>'Profile image update successfully'];
        }else{
            return ['errors'=>'Profile image could not be update'];
        }
    }

    function changePassword(){
        return view('frontend.auth.passwords.change_password');
    }

    function updatePassword(Request $request){

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed'
        ],
        [
            'password.required' => 'Please Enter New Password!',
        ]);

        if ($validator->fails())
        {
            return ['errors' => $validator->errors()->first()];
        }

        $find_user = User::find(Auth::user()->id);

        if (!Hash::check($request->old_password, $find_user->password)){
            return ['errors' => 'Wrong old password'];
        }

        $data = [];
        $data['password'] =  Hash::make($request->password);

        $update_password = User::where('id', Auth::user()->id)->update($data);

        if ($update_password){
            return ['success'=>'Password update successfully'];
        }else{
            return ['errors'=>'Profile could not be update'];
        }
    }
}
