<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Support\Facades\Response;

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

    public function subscribe()
    {
        $user = Auth::user();
        return view('subscribe',['intent' => $user->createSetupIntent()]); 
    }

    public function subscribePost(Request $request)
    {
        $user = Auth::user();
        $user->newSubscription('Subscription', $request->plan)->create($request->paymentMethod);
        return redirect('/home')->with('status', 'You Are Now Subscribed, Enjoy!'); 
    }

    public function endSubscribe(){
        $user = Auth::user();
        return view('endSub', ['user' => $user]);
    }

    public function end(){
        $user = Auth::user();
        //$user->subscription('Subscription')->cancel();
        $user->subscription('Subscription')->cancelNow();
        return redirect('/home')->with('status', 'Your subscription was cancelled successfully'); 
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

    public function editCv(){
        $user = Auth::user();
        return view('user.cv', ['user' => $user]);
}

    public function search(Request $request)
    {
        $u = Auth::user();
        if($u->type == 0){
            if($request->has('localization_main') && $request->has('localization_sec')){
                $user = User::where('type', 1)->where('position_main', $u->position_main)->where(function ($query) use ($request){ $query->where('localization_main',$request->localization_main) ->orWhere('localization_sec', $request->localization_sec);})->where('years', '>=', $u->years)->paginate(12);
            } else if($request->has('localization_main')){
                $user = User::where('type', 1)->where('position_main', $u->position_main)->where('localization_main', $request->localization_main)->where('years', '>=', $u->years)->paginate(12);
            }
            else if($request->has('localization_sec')){
                $user = User::where('type', 1)->where('position_main', $u->position_main)->where('localization_sec', $request->localization_sec)->where('years', '>=', $u->years)->paginate(12);
            }
            else{
                $user= User::where('type', 1)->where('position_main', $u->position_main)->where('years', '>=', $u->years)->paginate(12);
            }
            return view('user.list',['user'=>$user]);
        } else {
            if($request->has('localization_main') && $request->has('localization_sec')){
                $user = User::where('type', 0)->where('position_main', $u->position_main)->where(function ($query) use ($request){ $query->where('localization_main',$request->localization_main) ->orWhere('localization_sec', $request->localization_sec);})->where('years', '<=', $u->years)->paginate(12);
            } else if($request->has('localization_main')){
                $user = User::where('type', 0)->where('position_main', $u->position_main)->where('localization_main', $request->localization_main)->where('years', '<=', $u->years)->paginate(12);
            }
            else if($request->has('localization_sec')){
                $user = User::where('type', 0)->where('position_main', $u->position_main)->where('localization_sec', $request->localization_sec)->where('years', '<=', $u->years)->paginate(12);
            }
            else{
                $user= User::where('type', 0)->where('position_main', $u->position_main)->where('years', '<=', $u->years)->paginate(12);
            }
            return view('empresa.list',['user'=>$user]);
        }
    }

    public function email(Request $request){
        $user=Auth::user();
        $dest=User::where('id', $request->id)->first();

        $send = new \stdClass();
        if($user->type==1){
            $send->userName = $user->name;
            $send->userLastName = $user->lastLame;
            $send->userEmail = $user->email;
            $send->compName = $dest->name;
            $send->compEmail = $dest->email;
            $send->position_main = $user->position_main;
            $send->position_sec = $user->position_sec;
            $send->type = $user->type;
        }else{
            $send->compName = $user->name;
            $send->compEmail = $user->email;
            $send->userName = $dest->name;
            $send->userLastName = $dest->lastLame;
            $send->userEmail = $dest->email;
            $send->position_main = $user->position_main;
            $send->position_sec = $user->position_sec;
            $send->type = $user->type;
        }
        
        Mail::send(new \App\Mail\connection($send));   
        return redirect()->route('search')->with('email', 'Email has been sent!');
    }


    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $request->validate([
            'image' => 'required|image|max:5096',]);

        $request->file('image')->store('public/images');

        $user = Auth::user();
        $user->img = $request->file('image')->hashName();
        $user->save();

        return redirect()->route('home')->with('status', 'Image Has been updated!');
    }

    public function storeCv(Request $request)
    {
        $user = Auth::user()->id;
        $request->validate([
            'cv' => 'required|mimes:pdf|max:5096',]);

        $request->file('cv')->store('public/cv');

        $user = Auth::user();
        $user->cv = $request->file('cv')->hashName();
        $user->default = 0;
        $user->save();

        return redirect()->route('home')->with('status', 'CV Has been updated!');
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

        if($user->default == 0){
            $filepath = public_path() . "/storage/cv/".$user->cv;
            $data = date('d_m_y');
            $name = $user->name."_".$user->lastName."_".$data.".pdf";
            return Response::download($filepath, $name);
        }
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
        return $pdf->download($user->name.'_'.$user->lastName.'_'.date('d_m_y').'.pdf');
    }
}