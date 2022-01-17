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
        <ul style="list-style-type: none;">
            @php $reg=array('Norte','Centro','Sul'); @endphp

            @foreach($reg as $r)
            @if((isset($_GET['localization_sec']) && $_GET['localization_sec']==$r)||(isset($data->localization_sec) && $data->localization_sec==$r)) 
                <li><div class="form-check"><input checked type="radio" class="form-check-input" name="localization_sec" value = "{{ $r }}">{{ $r }}</div></li>
            @else
                <li><div class="form-check"><input type="radio" class="form-check-input" name="localization_sec" value = "{{ $r }}">{{ $r }}</div></li>
            @endif
        @endforeach
        </ul>  
    <br>
    <p>Localization:</p>
    <ul style="list-style-type: none;">
        @php $dist=array('Aveiro','Beja','Braga','Bragança','Castelo Branco','Coimbra','Évora','Faro','Guarda','Leiria','Lisboa','Portalegre','Porto','Santarém','Setubal','Viana do Castelo','Vila Real','Viseu'); @endphp  

        @foreach($dist as $d)
            @if((isset($_GET['localization_main']) && $_GET['localization_main']==$d)||(isset($data->localization_main) && $data->localization_main==$r)) 
                <li><div class="form-check"><input checked type="radio" class="form-check-input" name="localization_main" value = "{{ $d }}">{{ $d }}</div></li>
            @else
                <li><div class="form-check"><input type="radio" class="form-check-input" name="localization_main" value = "{{ $d }}">{{ $d }}</div></li>
            @endif
        @endforeach
    </ul> 
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
            @for($numcand=0,$numcell=0; $numcand < count($user) ; $numcand++,$numcell++)
                @if($numcell==4)
                    </tr><tr>
                    @php $numcell = 0; @endphp
                @endif
                <td>
                    <table>
                    <tr><td><img src="storage/images/{{ $user[$numcand]->img }}" alt='profilepic' height='200px' width='200px' style="object-fit: cover;"></td></tr>
                    <tr><td class="text-center">
                    {{ $user[$numcand]->name }} {{ $user[$numcand]->lastName }}<br>
                    {{ $user[$numcand]->position_sec }}<br>
                    {{ (int)$user[$numcand]->years }} Years of Experience<br>
                    {{ $user[$numcand]->localization_main }}<br>
                    @if(Auth::user()->subscribed('Subscription'))
                    <div class="btn-group">
                    <form method="POST" action="/email">
                    <button type="submit" class="btn btn-primary" name="id" value="{{$user[$numcand]->id}}">Email</button>
                    </form>

                    <form method='POST' action="/generate-pdf">
                    <button type='submit' class='btn btn-outline-primary' name="pdf" value="{{ $user[$numcand]->id }}">PDF</button>
                    </form>
                    </div></td>
                    @endif

                </td></tr></table>
            @endfor
    </tr>    
    </table>
    </div>
        @forelse($user as $a)
        @empty
        <h3 class="text-center">No Candidates have been found!</h3>
        @endforelse

    {!! $user->appends($data)->links('pagination::bootstrap-4')!!}
  </div> 
</div>
@endsection