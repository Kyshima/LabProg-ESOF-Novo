@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('End Subscription') }}</div>
                <div class="card-body">
                 When your subscription ends, you will lose some benefits like sending emails.
                 Are you sure you want to proceed?
                </div>
                <form action="{{ route('end')}}" method="POST">
                    @csrf
                <a class="btn btn-primary" style="padding-bottom:10px" href="{{ url('/home')}}">No</a>
                <button type="submit" style="padding-bottom:10px" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>
@endsection