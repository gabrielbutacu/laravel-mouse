<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        return view('test.view1');
    }

    public function save(Request $request){
        return 'sono dentro save: '.$request->input('first_name');
    }
}
