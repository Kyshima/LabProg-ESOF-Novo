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
    @if ($message = Session::get('pdf'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="table-responsive">
    <table class="table">
    <tr>
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
                    
                    echo "<div class='btn-group'>";
                    echo "<form method='POST' action=".'/email'.">";
                    echo "<button type='submit' class='btn btn-primary' name='enviado' value='".$user[$numcand]->name."|".$user[$numcand]->lastName."|".$user[$numcand]->email."|".$user[$numcand]->position_main."|".$user[$numcand]->position_sec."'>Email</button>";
                    echo "</form>";

                    echo "<form method='POST' action=".'/generate-pdf'.">";
                    echo "<button type='submit' class='btn btn-outline-primary' name='enviado' value='".$user[$numcand]->name."|".$user[$numcand]->lastName."|".$user[$numcand]->email."|".$user[$numcand]->position_main."|".$user[$numcand]->position_sec."|".$user[$numcand]->localization_main."|".$user[$numcand]->years."'>PDF</button>";
                    echo "</form>";
                    echo "</div></td>";

                echo '</td></tr></table>';
                }
            
        ?>
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