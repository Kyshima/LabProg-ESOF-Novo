<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
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
    public function list()
    {   
        $v = Auth::user();
        $user= User::where('type', 0)->where('position', $v->position)->paginate(18);
        return view('empresa.list',['user'=>$user]);
    }

    public function registerC()
    {
        return view('auth/registerCandidato');
    }

    public function registerE(){
        return view('auth/registerEmpresa');
    }
}
