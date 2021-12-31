@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Photo') }}</div>

                <div class="card-body">
                    <div class="col-md-6">
                        <form method="POST" enctype="multipart/form-data" id="img" action="{{ route('upload.picture') }}">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" name="image" placeholder="Choose image" id="img">
                                    @error('img')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection