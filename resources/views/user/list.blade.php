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

<div class="table-responsive-md">
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
                echo "<tr><td><img src='img/".$user[$numcand]->img."' alt='profilepic' height='200' width='200'></td></tr>";
                echo "<tr><td class='text-center'>";
                echo $user[$numcand]->name." ".$user[$numcand]->lastName."<br>";
                echo $user[$numcand]->position."<br>";
                echo $user[$numcand]->years."<br>";
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

{!! $user->links('pagination::bootstrap-4')!!}
@endsection