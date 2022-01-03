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
        @if($message = Session::get('status'))
                  <div class="card-body">
                  <div class= "alert alert-success">
                    <p>{{ $message }}</p>
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
                </div>
                <div class="card-body">
                  Check out your profile!
                </div>
                
                  <div class="card text-center" style="padding: 20px;">
                <?php
                    use App\Models\User;
                      $user = Auth::user();
                      if($user->type == 1){
                echo '<td>';
                echo '<table class=\'center\'>';
                echo "<tr><td><img src='storage/images/".$user->img."' alt='profilepic' height='200px' width='200px' style=\"object-fit: cover;\"></td></tr>";
                echo "<tr><td class='text-center'>";
                echo $user->name." ".$user->lastName."<br>";
                echo $user->position_main." - ".$user->position_sec."<br>";
                echo (int)$user->years." Years of Experience<br>";
                echo $user->localization_main."<br>";
                echo '</table>';
              }
                else{
                  echo "<table class='center'>";
                  echo "<tr class='bg-primary text-white'>";
                  echo "<th class='text-center'>Company's name</th>";
                  echo "<th class='text-center'>Localization</th>";
                  echo "<th class='text-center'>Area of Business</th>";
                  echo "<th class='text-center'>Position Wanted</th>";
                  echo "<th class='text-center'>Years of Experience Min</th>";
                  echo "</tr>";

                  
                  echo "<tr>";
                  echo "<td class='text-center'>".$user->name."</td>";
                  echo "<td class='text-center'>".$user->localization_main."</td>";
                  echo "<td class='text-center'>".$user->position_main."</td>";
                  echo "<td class='text-center'>".$user->position_sec."</td>";
                  echo "<td class='text-center'>".(int)$user->years."</td>";
                  echo "</tr>";
                  echo "</table>";
                }
                ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
