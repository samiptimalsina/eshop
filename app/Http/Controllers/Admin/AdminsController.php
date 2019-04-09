<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Component\fileHandlerComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public $fileHandler;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->fileHandler = new fileHandlerComponent();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return redirect('admin/dashboard');
    }

    function showProfile(){
        return view('admin.profile.show_profile');
    }

    /**
     * Update admin profile info
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function updateProfile(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' .Auth::user()->id,
        ]);

        $admin = Admin::where('id', Auth::user()->id)->first();
        $update = $admin->update($request->all());

        if ($update){
            return back()->with('success', 'Profile update successfully');
        }else{
            return back()->with('error', 'Profile could not be update');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function changePassword(){
        return view('admin.auth.passwords.change_password');
    }

    /**
     * Update admin password
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function updatePassword(Request $request){

        $this->validate($request, [
            'password' => 'required|min:6|confirmed'
        ]);

        $data = [];
        $data['password'] =  Hash::make($request->password);

        $update_password = Admin::where('id', Auth::user()->id)
            ->update($data);

        if ($update_password){
            return back()->with('success', 'Password update successfully');
        }else{
            return back()->with('error', 'Profile could not be update');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function changeProfilePicture(){
        return view('admin.profile.show_profile_picture');
    }

    function updateProfilePicture(Request $request){

        $this->validate($request, [
            'img' => 'required'
        ]);

        $admin = Admin::where('id', Auth::user()->id)->first();

        if ($request->img){
            $image_name = $this->fileHandler->imageUpload($request->file('img'), 'img');

            if ($image_name){
                $request['image'] = $image_name;
            }

            //Delete old image
            if ($admin->image){
                $this->fileHandler->deleteImage($admin->image);
            }
        }

        $update = $admin->update($request->all());

        if ($update){
            return back()->with('success', 'Profile picture update successfully');
        }else{
            return back()->with('error', 'Profile picture could not be update');
        }
    }

}
