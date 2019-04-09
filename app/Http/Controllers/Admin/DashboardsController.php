<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class DashBoardsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    function index(){

        return view('admin.dashboard.index');
    }
}
