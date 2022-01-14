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
        $u = Auth::user();
        $data = User::where('type', 0)->where('email', $u->email)->get();
        return view('home', ['data' => $data]); 
    }

    public function lists()
    {
        $u = Auth::user();
        $data = User::where('type', 0)->where('email', $u->email)->get();
        return view('empresa.options', ['data' => $data]); 
    }

    public function edit(){
        $user = Auth::user();
        if($user->type == 1){
            return view('user.edit', ['user' => $user]);
        }
        return view('empresa.edit', ['user' => $user]);
    }

    public function editEmpresa(Request $request){
        Auth::logout(); 
        $user = User::find($request->id);
        Auth::login($user);
        return $this->edit();
    }

    public function removeEmpresa(Request $request){
        Auth::logout(); 
        $user = User::find($request->id);
        Auth::login($user);
        return $this->delete();
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
            return view('user.list',['user'=>$user]);
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
        return view('empresa.list',['user'=>$user]);
        }
    }

    public function email(Request $request){

        $user= Auth::user();
        $dest = User::where('id', $request->id)->first();
        
        Mail::send(new \App\Mail\connection($user,$dest));   
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
        $u = Auth::user();
        $data = User::where('type', 0)->where('email', $u->email)->get();
        $email=$u->email;

        $user = User::find(Auth::user()->id);
        Auth::logout();
        $user->delete();

        if(count($data)==1){
            return redirect()->route('first')->with('global', 'Your account has been deleted!');;
        } else {
            $data = User::where('type', 0)->where('email', $email)->first();
            $user = User::find($data->id);
            Auth::login($user);
            return redirect()->route('home')->with('status', 'Your Position has been Removed!');
        }  
    }

    public function generatePDF(Request $request){
        $user = User::where('id', $request->pdf)->first();
        $data = [
            'title' => 'Curriculum Vitae',
            'date' => date('d/M/Y'),
            'name' => $user->name,
            'lastName' => $user->lastName,
            'email' => $user->email,
            'position_main' => $user->position_main,
            'position_sec' => $user->position_sec,
            'localization_main' => $user->localization_main,
            'years' => (int) $user->years,
        ];

        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download($user->name.'_'.$user->lastName.'_'.date('d/m/y').'.pdf');
    }
}
