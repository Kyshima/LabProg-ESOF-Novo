<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;

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
        return view('home');
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
        switch($request->localization_main){
            case 'Viana do Castelo': case 'Braga': case 'Porto': case 'Vila Real': case 'Bragança':    $user->localization_sec = 'Norte'; break;
            case 'Aveiro': case 'Viseu': case 'Guarda': case 'Coimbra': case 'Castelo Branco': case 'Leiria': case 'Santarém': case 'Lisboa': case 'Portalegre': $user->localization_sec ='Centro'; break;
            case 'Évora': case 'Setubal': case 'Beja': case 'Faro': $user->localization_sec ='Sul'; break;
        }
        $user->update($request->all());
        return redirect()->route('home')->with('status', 'Your profile has been updated!');
    }

    public function editPhoto(){
            $user = Auth::user();
            return view('user.upload', ['user' => $user]);
    }

    public function search(Request $request)
    {
        $v = Auth::user();
        if($v->type == 0){
        $data = $request->all();
        if($request->has('localization_main')){
            if(($request->has('localization_sec')))  $data->localization_sec = null;
            $user = User::where('type', 1)->where('position_main', $v->position_main)->where('localization_main', $request->localization_main)->where('years', '>=', $v->years)->paginate(12);
        }
        else if($request->has('localization_sec')){
            if(($request->has('localization_main')))  $data->localization_main = null;
            $user = User::where('type', 1)->where('position_main', $v->position_main)->where('localization_sec', $request->localization_sec)->where('years', '>=', $v->years)->paginate(12);
        }
        else{
            $user= User::where('type', 1)->where('position_main', $v->position_main)->where('years', '>=', $v->years)->paginate(12);
            $data = $request->all();
        }
        return view('user.list',['user'=>$user, 'data'=> $data]);
        }
        
        else{
            $data = $request->all();
        if($request->has('localization_main')){
            if(($request->has('localization_sec')))  $data->localization_sec = null;
            $user = User::where('type', 0)->where('position_main', $v->position_main)->where('localization_main', $request->localization_main)->where('years', '<=', $v->years)->paginate(12);
        }
        else if($request->has('localization_sec')){
            if(($request->has('localization_main')))  $data->localization_main = null;
            $user = User::where('type', 0)->where('position_main', $v->position_main)->where('localization_sec', $request->localization_sec)->where('years', '<=', $v->years)->paginate(12);
        }
        else{
            $user= User::where('type', 0)->where('position_main', $v->position_main)->where('years', '<=', $v->years)->paginate(12);
            $data = $request->all();
        }
        return view('empresa.list',['user'=>$user, 'data'=> $data]);
        }
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
            $send->position_main = $str[2];
            $send->position_sec = $str[3];
            $send->type = $user->type;
        }else{
            $send = new \stdClass();
            $send->compName = $user->name;
            $send->compEmail = $user->email;
            $str=explode('|',$request->enviado);
            $send->userName = $str[0];
            $send->userLastName = $str[1];
            $send->userEmail = $str[2];
            $send->position_main = $str[3];
            $send->position_sec = $str[4];
            $send->type = $user->type;
        }
        
        Mail::send(new \App\Mail\connection($send,$user->type));   
        return redirect()->route('search')->with('email', 'Email has been sent!');
    }


    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $request->validate([
            'image' => 'required|image|max:5096',]);
        
        
        $imageName = time().'_'.$user.'.'.$request->image->extension();

        $request->file('image')->store('public/images');

        $user = Auth::user();
        $user->img = $request->file('image')->hashName();
        $user->save();

        return redirect()->route('home')->with('status', 'Image Has been updated!');
    }

    public function delete(){
        $user = Auth::user();
        return view('delete', ['user' => $user]);
    }

    public function erase(){
        $user = User::find(Auth::user()->id);
        Auth::logout();
        $user->delete();
        return redirect()->route('first')->with('global', 'Your account has been deleted!');;
    }

    public function generatePDF(Request $request){
        $send = new \stdClass();
        $str=explode('|',$request->enviado);
        $send->userName = $str[0];
        $send->userLastName = $str[1];
        $send->userEmail = $str[2];
        $send->position_main = $str[3];
        $send->position_sec = $str[4];
        $send->localization_main = $str[5];
        $send->years = $str[6];

        $data = [
            'title' => 'Curriculum Vitae',
            'date' => date('d/M/Y'),
            'name' => $str[0],
            'lastName' => $str[1],
            'email' => $str[2],
            'position_main' => $str[3],
            'position_sec' => $str[4],
            'localization_main' => $str[5],
            'years' => (int) $str[6],
        ];

        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download($str[0].'_'.$str[1].'_'.date('d/m/y').'.pdf');
    }
}
