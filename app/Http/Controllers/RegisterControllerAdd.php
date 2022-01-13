<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterControllerAdd extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function empresaAdd()
    {
        $user = Auth::user();
        return view('empresa.add',['user' => $user]);
    }

    public function empresaAddNew(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
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
            'position_main' => ['required','regex:/^(Administrative|Computer Science|Culinary|Design|Education|Public Services|Services to the Public|Other)$/'],
            'position_sec' => ['required','max:50'],
            'years' => ['required','min:0','max:45'],
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
        $user = Auth::user();
        return User::create([
            'name' => $user->name,
            'lastName' => $user->lastName,
            'position_main' => $data['position_main'],
            'position_sec' => $data['position_sec'],
            'localization_main' => $user->localization_main,
            'localization_sec' => $user->localization_sec,
            'years' => $data['years'],
            'email' => $user->email,
            'password' => $user->password,
            'default' => $user->default,
            'img' => $user->img,
            'type' => $user->type,
            'email_verified_at' => $user->email_verified_at
        ]);
    }
}

