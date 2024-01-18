@extends('layouts.template')
@section('title', 'New Site')
@section('content')

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

<div class="col-12">
    <div class="card">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.new_site') }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('sites.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="site_name">{{ __('messages.name') }}</label>
                        <input type="text" class="form-control" name="site_name">
                    </div>                    
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="site_abbreviation">{{ __('messages.abbreviation') }}</label>
                        <input type="text" class="form-control" name="site_abbreviation">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="site_address">{{ __('messages.address') }}</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" type="text" name="site_address"></textarea>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">{{ __('messages.submit') }}</button>
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('sites.allsite') }}">{{ __('messages.cancel') }}</a>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection