@extends('layouts.template')
@section('title', 'Edit Asset')
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

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="col-12">
    <div class="card">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.edit_asset') }}</h4>
            <div class="btn-text-right">
                <a href="{{ route('equipments.allassetlog',$equipment->id) }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-label'></i>&nbsp; {{ __('messages.asset_log') }}</button>
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('equipments.allassetupdate',['equipment' => $equipment->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="asset_hostname">{{ __('messages.hostname') }}</label>
                        <input type="text" class="form-control" name="asset_hostname" value="{{ $equipment->asset_hostname }}">
                    </div>
                    <div class="mb-3 col-md-6">
                    <label class="form-label" for="asset_location">{{ __('messages.asset_location') }} [{{ __('messages.asset_note') }}]</label>
                        <input type="text" class="form-control" name="asset_location" value="{{ $equipment->asset_location }}" readonly>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="asset_ip">{{ __('messages.asset_ip') }}</label>
                        <input type="text" class="form-control" name="asset_ip" value="{{ $equipment->asset_ip }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="asset_type">{{ __('messages.asset_type') }}</label>
                        <input type="text" class="form-control" name="asset_type" value="{{ $equipment->asset_type }}">
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
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="asset_kewpa">{{ __('messages.asset_kewpa') }}</label>
                        <input type="text" class="form-control" name="asset_kewpa" value="{{ $equipment->asset_kewpa }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="asset_seriesno">{{ __('messages.asset_seriesno') }}</label>
                        <input type="text" class="form-control" name="asset_seriesno" value="{{ $equipment->asset_seriesno }}">
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">{{ __('messages.update') }}</button>
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('equipments.allasset') }}">{{ __('messages.cancel') }}</a>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection