@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
            <br>
        @endif
        @if($message = Session::get('status'))
                  <div class="card-body">
                  <div class= "alert alert-success">
                    <p>{{ $message }}</p>
                  </div>
                  </div>
                  @endif
        @if(!Auth::user()->subscribed('Subscription'))
                  <div class="card-body">
                  <div class= "alert alert-primary">
                    <h5>You Are Not Subscribed!</h5>
                    <p>To Subscribe to Our Monthly Plan and get the best out of our service Click <a href="/subscribe">Here!</a></p>
                  </div>
                  </div>
                  @endif
    </div>
  </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                  Welcome {{ Auth::user()->name }}! 
                  <br>
                  @if(Auth::user()->subscribed('Subscription'))
                  You are Subscribed!
                  <br>
                  @if(Auth::user()->cancelled == 0)
                  Your Subscription renews in {{Auth::user()->endSub}}!
                  @elseif(Auth::user()->cancelled == 1 && Auth::user()->endSub > date('Y,m,d'))
                  Your Subscription ends in {{Auth::user()->endSub}}!
                  @endif
                  <br>
                  @else
                  Basic Account!
                  <br>
                  @endif

                Check out your profile!
                </div>

                
                  <div class="card text-center" style="padding: 20px;">
                    @if(Auth::user()->type == 1)
                      <td>
                      <table class="center">
                      <tr><td><img src="storage/images/{{ Auth::user()->img }}" alt="profilepic" height="200px" width="200px" style="object-fit: cover;"></td></tr>
                      <tr><td class="text-center">
                      {{ Auth::user()->name }} {{ Auth::user()->lastName }}<br>
                      {{ Auth::user()->position_main }} - {{ Auth::user()->position_sec }}<br>
                      {{ (int)Auth::user()->years }} Years of Experience<br>
                      {{ Auth::user()->localization_main }}<br>
                    </table>
                    @else
                    <table class='center'>
                      <tr class='bg-primary text-white'>
                      <th class='text-center'>Company's name</th>
                      <th class='text-center'>Localization</th>
                      <th class='text-center'>Area of Business</th>
                      <th class='text-center'>Position Wanted</th>
                      <th class='text-center'>Years of Experience Min</th>
                      </tr>
                    @foreach($data as $d)
                      <tr>
                      <td class='text-center'>{{ $d->name }}</td>
                      <td class='text-center'>{{ $d->localization_main }}</td>
                      <td class='text-center'>{{ $d->position_main }}</td>
                      <td class='text-center'>{{ $d->position_sec }}</td>
                      <td class='text-center'>{{ (int)$d->years }}</td>
                      </tr>
                    @endforeach
                    </table>
                    @endif
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
