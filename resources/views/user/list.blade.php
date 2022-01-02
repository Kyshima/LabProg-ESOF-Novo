@extends('layouts.lists')

@section('title')
Candidatos
@endsection

@section('content')

<?php
dd($data);
?>
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
        <option value="Aveiro">Aveiro</option>
        <option value="Beja">Beja</option>
        <option value="Braga">Braga</option>
        <option value="Bragança">Bragança</option>
        <option value="Castelo Branco">Castelo Branco</option>
        <option value="Coimbra">Coimbra</option>
        <option value="Faro">Faro</option>
        <option value="Guarda">Guarda</option>
        <option value="Leiria">Leiria</option>
        <option value="Lisboa">Lisboa</option>
        <option value="Portalegre">Portalegre</option>
        <option value="Porto">Porto</option>
        <option value="Santarém">Santarém</option>
        <option value="Setubal">Setubal</option>
        <option value="Viana do Castelo">Viana do Castelo</option>
        <option value="Vila Real">Vila Real</option>
        <option value="Viseu">Viseu</option>
        <option value="Évora">Évora</option>
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
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="table-responsive">
    <table class="table">
    <tr>
    <form method='POST' action="{{ route('email') }}">
            @csrf
        <?php
            for($numcand=0,$numcell=0;$numcand<count($user);$numcand++,$numcell++){
                if($numcell==4){
                    echo '</tr><tr>';
                    $numcell = 0;
                }
                echo '<td>';
                    echo '<table>';
                    echo "<tr><td><img src='storage/images/".$user[$numcand]->img."' alt='profilepic' height='200px' width='200px' style=\"object-fit: cover;\"></td></tr>";
                    echo "<tr><td class='text-center'>";
                    echo $user[$numcand]->name." ".$user[$numcand]->lastName."<br>";
                    echo $user[$numcand]->position_sec."<br>";
                    echo (int)$user[$numcand]->years." Years of Experience<br>";
                    echo $user[$numcand]->localization_main."<br>";
                    echo "<button type='submit' class='btn btn-primary' name='enviado' value='".$user[$numcand]->name."|".$user[$numcand]->lastName."|".$user[$numcand]->email."|".$user[$numcand]->position."'>Email</button></td>";
                echo '</td></tr></table>';
                }
            
        ?>
        </form>
    </tr>    
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