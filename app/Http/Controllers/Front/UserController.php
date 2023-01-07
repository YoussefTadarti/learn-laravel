<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function welcome(){
       /* $data['name']='youssef tadarti';
        $data['age']= '12';
        return view("welcome",$data);*/

        $obj = new \stdClass();
        $obj->id = 3;
        $obj->name = "Youssef";
        return view('welcome',compact('obj'));

    }
}
