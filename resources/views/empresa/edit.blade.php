@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/update') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="position_main" class="col-md-4 col-form-label text-md-end">{{ __('Position Area') }}</label>

                            <div class="col-md-6">
                                <!--<input id="position_main" type="text" class="form-control @error('position') is-invalid @enderror" name="position_main" value="{{ old('position_main') }}" required autocomplete="position_main" autofocus>-->
                                <select id="position_main" name="position_main" class="form-select form-control @error('position_main') is-invalid @enderror" autofocus>
                                    <option {{($user->position_main) == 'Administrative' ? 'selected' : ''}}  value="Administrative">Administrative</option>
                                    <option {{($user->position_main) == 'Computer Science' ? 'selected' : ''}}  value="Computer Science">Computer Science</option>
                                    <option {{($user->position_main) == 'Culinary' ? 'selected' : ''}}  value="Culinary">Culinary</option>
                                    <option {{($user->position_main) == 'Design' ? 'selected' : ''}}  value="Design">Design</option>
                                    <option {{($user->position_main) == 'Education' ? 'selected' : ''}}  value="Education">Education</option>
                                    <option {{($user->position_main) == 'Public Services' ? 'selected' : ''}}  value="Public Services">Public Services</option>
                                    <option {{($user->position_main) == 'Services to the Public' ? 'selected' : ''}}  value="Services to the Public">Services to the Public</option>
                                    <option {{($user->position_main) == 'Other' ? 'selected' : ''}}  value="Other">Other</option>
                                </select>

                                @error('position_main')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="position_sec" class="col-md-4 col-form-label text-md-end">{{ __('Position') }}</label>

                            <div class="col-md-6">
                                <input id="position_sec" type="text" class="form-control @error('position_sec') is-invalid @enderror" name="position_sec" value="{{ $user->position_sec }}" required autocomplete="position_sec" autofocus>

                                @error('position_sec')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="localization_main" class="col-md-4 col-form-label text-md-end">{{ __('Localization City') }}</label>

                            <div class="col-md-6">
                                <!--<input id="localization_main" type="text" class="form-control @error('localization_main') is-invalid @enderror" name="localization_main" value="{{ old('localization_main') }}" required autocomplete="localization_main" autofocus>-->
                                <select id="localization_main" name="localization_main" class="form-select form-control @error('localization_main') is-invalid @enderror" autofocus>
                                    <option {{($user->localization_main) == 'Aveiro' ? 'selected' : ''}} value="Aveiro">Aveiro</option>
                                    <option {{($user->localization_main) == 'Beja' ? 'selected' : ''}} value="Beja">Beja</option>
                                    <option {{($user->localization_main) == 'Braga' ? 'selected' : ''}} value="Braga">Braga</option>
                                    <option {{($user->localization_main) == 'Bragança' ? 'selected' : ''}} value="Bragança">Bragança</option>
                                    <option {{($user->localization_main) == 'Castelo Branco' ? 'selected' : ''}} value="Castelo Branco">Castelo Branco</option>
                                    <option {{($user->localization_main) == 'Coimbra' ? 'selected' : ''}} value="Coimbra">Coimbra</option>
                                    <option {{($user->localization_main) == 'Faro' ? 'selected' : ''}} value="Faro">Faro</option>
                                    <option {{($user->localization_main) == 'Guarda' ? 'selected' : ''}} value="Guarda">Guarda</option>
                                    <option {{($user->localization_main) == 'Leiria' ? 'selected' : ''}} value="Leiria">Leiria</option>
                                    <option {{($user->localization_main) == 'Lisboa' ? 'selected' : ''}} value="Lisboa">Lisboa</option>
                                    <option {{($user->localization_main) == 'Portalegre' ? 'selected' : ''}} value="Portalegre">Portalegre</option>
                                    <option {{($user->localization_main) == 'Porto' ? 'selected' : ''}} value="Porto">Porto</option>
                                    <option {{($user->localization_main) == 'Santarém' ? 'selected' : ''}} value="Santarém">Santarém</option>
                                    <option {{($user->localization_main) == 'Setubal' ? 'selected' : ''}} value="Setubal">Setubal</option>
                                    <option {{($user->localization_main) == 'Viana do Castelo' ? 'selected' : ''}} value="Viana do Castelo">Viana do Castelo</option>
                                    <option {{($user->localization_main) == 'Vila Real' ? 'selected' : ''}} value="Vila Real">Vila Real</option>
                                    <option {{($user->localization_main) == 'Viseu' ? 'selected' : ''}} value="Viseu">Viseu</option>
                                    <option {{($user->localization_main) == 'Évora' ? 'selected' : ''}} value="Évora">Évora</option>
                                </select>

                                @error('localization_main')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="years" class="col-md-4 col-form-label text-md-end">{{ __('Years of Experience') }}</label>

                            <div class="col-md-6">
                                <input id="years" type="number" class="form-control @error('years') is-invalid @enderror" name="years" value="{{ $user->years }}" required autocomplete="years">

                                @error('years')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input type='hidden' name='img' value='{{ $user->img }}'>
                        <input type='hidden' name='default' value='{{ $user->default }}'>
                        <input type='hidden' name='type' value='{{ $user->type }}'>
                        <input type='hidden' name='lastName' value='{{ $user->lastName }}'>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Finish Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
