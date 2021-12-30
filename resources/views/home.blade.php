@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm"></div>
    <div class="col-sm">
        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
            <br>
        @endif
    </div>
    <div class="col-sm"></div>
  </div>
</div>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                  Welcome {{ Auth::user()->name }}!
                    <form method="POST" action="{{ route('email') }}">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
