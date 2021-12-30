@extends('layouts.app')

@section('title')
Candidatos
@endsection

@section('content')

@if ($message = Session::get('success'))
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
                echo "<td class='text-center'>".$user[$numcand]->localization."</td>";
                echo "<td class='text-center'>".(int)$user[$numcand]->years."</td>";
                echo "<td class='text-center'>".$user[$numcand]->position."</td>";

                echo "<td class='text-center'><button type='submit' class='btn btn-primary' name='enviado' value='".$user[$numcand]->name."|".$user[$numcand]->email."|".$user[$numcand]->position."'>Email</button></td>";
                echo "</tr>";
            } 
    ?> 
    </form>
</table>
</div>

    @forelse($user as $a)
    @empty
    <h3 class="text-center">Não existe Empresas!</h3>
    @endforelse

{!! $user->links('pagination::bootstrap-4')!!}
@endsection