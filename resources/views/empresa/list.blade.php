@extends('layouts.lists')

@section('title')
Candidatos
@endsection

@section('content')

<div class="row">
  <div class="col-sm-2">

  <h4>SEARCH:</h4>

  <form method="GET" action="{{ route('search') }}">
    <br> Region:
    <div class="row">
    <div class="col">
        <ul style="list-style-type: none;">
            <li><div class="form-check"><input type="radio" class="form-check-input" name="localization_sec" value = "Norte">Norte</div></li>
            <li><div class="form-check"><input type="radio" class="form-check-input" name="localization_sec" value = "Centro">Centro</div></li>
            <li><div class="form-check"><input type="radio" class="form-check-input" name="localization_sec" value = "Sul">Sul</div></li>
        </ul>  
    </div>
    <div class="col">
        <button type="submit" class="btn btn-primary">
            {{ __('Search') }}
        </button>
    </div>
    </div>
    </form>

    <br>
    
    <p>Localization:</p>
    <form method="GET" action="{{ route('search') }}">
    <select id="localization_main" name="localization_main" class="form-select form-control @error('localization_main') is-invalid @enderror" autofocus>
        <?php
            $dist=array('Aveiro','Beja','Braga','Bragança','Castelo Branco','Coimbra','Évora','Faro','Guarda','Leiria','Lisboa','Portalegre','Porto','Santarém','Setubal','Viana do Castelo','Vila Real','Viseu');
            if(isset($data['localization_main'])) {$tt = $data['localization_main'];}
            else {$tt = '';}

            foreach($dist as $d){
                if($d != $tt) {
                echo "<option value='".$d."'>".$d."</option>";
                }else{
                    echo "<option selected value='".$d."'>".$d."</option>";
                }
            }
        ?>
    </select>
    <br>
    <div class="text-center">
    <button type="submit" class="btn btn-primary">
            {{ __('Search') }}
    </button>
    </div>
  </form>
  <br>
  <form action="{{route('search')}}">
  <div class="text-center">
    <button type="submit" class="btn btn-secondary">
            {{ __('Reset') }}
    </button>
    </div>
    </form>
  </div>


  <div class="col-sm-8">
    @if ($message = Session::get('email'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="table-responsive-sm">
<table class="table table-bordered">
    <tr class="bg-primary text-white">
        <th class="text-center">Company's name</th>
        <th class='text-center'>Localization</th>
        <th class='text-center'>Years of Experience Min</th>
        <th class='text-center'>Position Wanted</th>
        <th class='text-center'>Email</th>
    </tr>
    <form method='POST' action="{{ route('email') }}">
        @csrf
    <?php
        use App\Models\User;
        for($numcand=0;$numcand<count($user);$numcand++){
                echo "<tr>";
                echo "<td class='text-center'>".$user[$numcand]->name."</td>";
                echo "<td class='text-center'>".$user[$numcand]->localization_main."</td>";
                echo "<td class='text-center'>".(int)$user[$numcand]->years."</td>";
                echo "<td class='text-center'>".$user[$numcand]->position_sec."</td>";

                echo "<td class='text-center'><button type='submit' class='btn btn-primary' name='enviado' value='".$user[$numcand]->name."|".$user[$numcand]->email."|".$user[$numcand]->position_main."|".$user[$numcand]->position_sec."'>Email</button></td>";
                echo "</tr>";
            } 
    ?> 
    </form>
</table>
</div>
        @forelse($user as $a)
        @empty
        <h3 class="text-center">Não existe Candidatos!</h3>
        @endforelse

    {!! $user->appends($data)->links('pagination::bootstrap-4')!!}
  </div> 

</div>
@endsection