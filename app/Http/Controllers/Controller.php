<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        return view('index');
    }

    public function teste(){
        return view('teste');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $v = Auth::user();
        $data = $request->all();
        if($request->has('localization_main')){
            if(($request->has('localization_sec')))  $data->localization_sec = null;
            $user = User::where('type', 0)->where('position_main', $v->position_main)->where('localization_main', $request->localization_main)->paginate(12);
        }
        else if($request->has('localization_sec')){
            if(($request->has('localization_main')))  $data->localization_main = null;
            $user = User::where('type', 0)->where('position_main', $v->position_main)->where('localization_sec', $request->localization_sec)->paginate(12);
        }
        else{
            $user= User::where('type', 0)->where('position_main', $v->position_main)->paginate(12);
            $data = $request->all();
        }
        return view('empresa.list',['user'=>$user, 'data'=> $data]);
    }

    public function registerC()
    {
        return view('auth/registerCandidato');
    }

    public function registerE(){
        return view('auth/registerEmpresa');
    }
}
