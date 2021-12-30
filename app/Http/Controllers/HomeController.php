<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function empresaIndex()
    {
        return view('empresaHome');
    }

    public function listC()
    {
        $user= User::where('type', 1)->paginate(12);
        return view('user.list',['user'=>$user]);
    }

    public function email(Request $request){
        $user= Auth::user();
        if($user->type==1){
            $send = new \stdClass();
            $send->userName = $user->name;
            $send->userLastName = $user->lastLame;
            $send->userEmail = $user->email;
            $str=explode('|',$request->enviado);
            $send->compName = $str[0];
            $send->compEmail = $str[1];
            $send->type = $user->type;

            /*$user1=$user;
            $user2=new User();
            $user2->name=$request->userName;
            $user2->email=$request->userEmail;*/
        }else{
            /*$user2=$user;
            $user1=new User();
            $user1->name=$request->userName;
            $user1->email=$request->userEmail;*/
        }
        



        /*$user=new User;
        $user->email='antoine@uuu.pts';
        $user->name='antonio';   */ 
        //return new \App\Mail\connection(/*$user1,$user2,*/$send,$user->type);
        Mail::send(new \App\Mail\connection(/*$user1,$user2,*/$send,$user->type));   
        return view('home');
    }
}
