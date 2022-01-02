@extends('layouts.app')

@section('title')
Home
@endsection

@section('content')
@if($message = Session::get('global'))
                  <div class="card-body">
                  <div class= "alert alert-success">
                    <p>{{ $message }}</p>
                  </div>
                  </div>
                @endif
<h1 class="mt-5 mb-3 text-center text-primary">Eterno Candidato</h1>
<h4 class="mt-5 mb-3 text-center">Are you ready for your next challenge in your career?</h4>
<h4 class="mt-5 mb-3 text-center">Or are you looking for someone who can take your team to the next level?</h4>
<h4 class="mt-5 mb-3 text-center">You can find everyone you need, from Chefs to Mechanics, here in Eterno Candidato!</h4>
@endsection