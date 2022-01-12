@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lastName" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>

                                @error('lastName')
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
                                <select id="position_main" name="position_main" class="form-select form-control @error('position_main') is-invalid @enderror" value="{{ old('position_main') }}" autofocus>
                                    <option value="Administrative">Administrative</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Culinary">Culinary</option>
                                    <option value="Design">Design</option>
                                    <option value="Education">Education</option>
                                    <option value="Public Services">Public Services</option>
                                    <option value="Services to the Public">Services to the Public</option>
                                    <option value="Other">Other</option>
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
                                <input id="position_sec" type="text" class="form-control @error('position_sec') is-invalid @enderror" name="position_sec" value="{{ old('position_sec') }}" required autocomplete="position_sec" autofocus>

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
                                <select id="localization_main" name="localization_main" class="form-select form-control @error('localization_main') is-invalid @enderror" value="{{ old('localization_main') }}" autofocus>
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
                                <input id="years" type="number" class="form-control @error('years') is-invalid @enderror" name="years" value="{{ old('years') }}" required autocomplete="years">

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <input type='hidden' name='default' value='1'>
                        <input type='hidden' name='img' value='default.jpg'>
                        <input type='hidden' name='type' value='1'>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4" style="text-align: center;">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
