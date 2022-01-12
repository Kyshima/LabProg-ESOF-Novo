<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:25'],
            'lastName' => ['max:25'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'position_main' => ['required','regex:/^(Administrative|Computer Science|Culinary|Design|Education|Public Services|Services to the Public|Other)$/'],
            'position_sec' => ['required','max:50'],
            'localization_main' => ['required','regex:/^(Viana do Castelo|Braga|Porto|Vila Real|Bragança|Aveiro|Viseu|Guarda|Coimbra|Castelo Branco|Leiria|Santarém|Lisboa|Portalegre|Évora|Setubal|Beja|Faro)$/'],
            'years' => ['required','min:0','max:45'],

            'type' => ['required','regex:/^[0-1]$/'],
        ]);
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        switch($data['localization_main']){
            case 'Viana do Castelo': case 'Braga': case 'Porto': case 'Vila Real': case 'Bragança':    $loc_sec='Norte'; break;
            case 'Aveiro': case 'Viseu': case 'Guarda': case 'Coimbra': case 'Castelo Branco': case 'Leiria': case 'Santarém': case 'Lisboa': case 'Portalegre': $loc_sec='Centro'; break;
            case 'Évora': case 'Setubal': case 'Beja': case 'Faro': $loc_sec='Sul'; break;
        }
        return User::create([
            'name' => $data['name'],
            'lastName' => $data['lastName'],
            'position_main' => $data['position_main'],
            'position_sec' => $data['position_sec'],
            'localization_main' => $data['localization_main'],
            'localization_sec' => $loc_sec,
            'years' => $data['years'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'default' => $data['default'],
            'img' => $data['img'],
            'type' => $data['type'],
        ]);
    }
}
