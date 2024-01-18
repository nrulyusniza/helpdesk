@extends('layouts.template')
@section('title', 'New Reporting Person')
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
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.new_reportingperson') }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('reportingpersons.entirereportingpersonstore') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="rptpers_name">{{ __('messages.fullname') }}</label>
                        <input type="text" class="form-control" name="rptpers_name">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="rptpers_mobile">{{ __('messages.phone_no') }}</label>
                        <input type="number" class="form-control" name="rptpers_mobile">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="site_id">{{ __('messages.site') }}</label>
                        <select id="defaultSelect" class="form-select" name="site_id">
                            @foreach(App\Site::all()->sortBy('site_name') as $site)
                                @if(auth()->user()->site_id == $site->id)                                    
                                    <option value="{{ $site->id }}" selected>{{ $site->site_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">{{ __('messages.submit') }}</button>
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('reportingpersons.entirereportingperson') }}">{{ __('messages.cancel') }}</a>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection