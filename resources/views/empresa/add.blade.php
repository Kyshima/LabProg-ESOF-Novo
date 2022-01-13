@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Position') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/addN') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="position_main" class="col-md-4 col-form-label text-md-end">{{ __('Position Area') }}</label>

                            <div class="col-md-6">
                                <select id="position_main" name="position_main" class="form-select form-control @error('position_main') is-invalid @enderror" autofocus>
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
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
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
