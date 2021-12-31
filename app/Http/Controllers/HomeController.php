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

    public function edit(){
        $user = Auth::user();
        if($user->type == 1){
            return view('user.edit', ['user' => $user]);
        }
        return view('empresa.edit', ['user' => $user]);
    }

    public function update(Request $request){
        $user = Auth::user();
        //$user->update($request->all());
        return redirect('/home');
    }

    public function listC()
    {
        $v = Auth::user();
        $user= User::where('type', 1)->where('position_main', $v->position_main)->paginate(12);
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
            $send->position = $str[2];
            $send->type = $user->type;
        }else{
            $send = new \stdClass();
            $send->compName = $user->name;
            $send->compEmail = $user->email;
            $str=explode('|',$request->enviado);
            $send->userName = $str[0];
            $send->userLastName = $str[1];
            $send->userEmail = $str[2];
            $send->position = $str[3];
            $send->type = $user->type;
        }
        
        Mail::send(new \App\Mail\connection($send,$user->type));   
        return redirect()->route('search');
    }
}
