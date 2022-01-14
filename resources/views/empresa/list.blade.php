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
            @if(isset($_GET['localization_sec']) && $_GET['localization_sec']==$r) 
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
            @if(isset($_GET['localization_main']) && $_GET['localization_main']==$d) 
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

    <div class="table-responsive-sm">
<table class="table table-bordered">
    <tr class="bg-primary text-white">
        <th class="text-center">Company's name</th>
        <th class="text-center">Localization</th>
        <th class="text-center">Years of Experience Min</th>
        <th class="text-center">Position Wanted</th>
        <th class="text-center">Email</th>
    </tr>
    <form method="POST" action="/email">
        @csrf

    @foreach($user as $u)
                <tr>
                <td class="text-center">{{$u->name}}</td>
                <td class="text-center">{{$u->localization_main}}</td>
                <td class="text-center">{{(int) $u->years}}</td>
                <td class="text-center">{{$u->position_main}}</td>
                <td class="text-center"><button type="submit" class="btn btn-primary" name="id" value="{{$u->id}}" >Email</button></td>
                </tr>
        @endforeach
    </form>
</table>
</div>
        @forelse($user as $a)
        @empty
        <h3 class="text-center">No Company has been found!</h3>
        @endforelse

    {!! $user->links('pagination::bootstrap-4')!!}
  </div> 

</div>
@endsection