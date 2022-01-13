@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>                
                  <div class="card text-center" style="padding: 20px;">
                    <table class='center'>
                      <tr class='bg-primary text-white'>
                      <th class='text-center'>Company's name</th>
                      <th class='text-center'>Localization</th>
                      <th class='text-center'>Area of Business</th>
                      <th class='text-center'>Position Wanted</th>
                      <th class='text-center'>Years of Experience Min</th>
                      <th class='text-center'>Edit</th>
                      <th class='text-center'>Remove</th>
                      </tr>
                    @foreach($data as $d)
                      <tr>
                      <td class='text-center'>{{ $d->name }}</td>
                      <td class='text-center'>{{ $d->localization_main }}</td>
                      <td class='text-center'>{{ $d->position_main }}</td>
                      <td class='text-center'>{{ $d->position_sec }}</td>
                      <td class='text-center'>{{ (int)$d->years }}</td>
                    <form method="POST" action="{{ url('/editEmpresa') }}">
                    @csrf
                      <td class='text-center'><button type="submit" class="btn btn-primary" name="id" value="{{ $d->id }}">Edit</button></td>
                    </form>
                    <form method="POST" action="{{ url('/removeEmpresa') }}">
                    @csrf
                      <td class='text-center'><button type="submit" class="btn btn-primary" name="id" value="{{ $d->id }}">Remove</button></td>
                    </form>
                      </tr>
                    @endforeach
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection