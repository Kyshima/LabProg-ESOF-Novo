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
<h4 class="mt-5 mb-3 text-center">És um empregador à procura do teu próximo talento? Ou uma pessoa à procura de um novo desafio para a tua carreira profissional?</h4>
<h4 class="mt-5 mb-3 text-center">Poderás encontrar tudo isso e mais, aqui só no Eterno Candidato!</h4>
@endsection