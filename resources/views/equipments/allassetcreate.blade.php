@extends('layouts.template')
@section('title', 'New Asset')
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
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.new_asset') }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('equipments.allassetstore') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="asset_hostname">{{ __('messages.hostname') }}</label>
                        <input type="text" class="form-control" name="asset_hostname">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="asset_location">{{ __('messages.origin_location') }}</label>
                        <input type="text" class="form-control" name="asset_location">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="asset_ip">{{ __('messages.asset_ip') }}</label>
                        <input type="text" class="form-control" name="asset_ip">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="asset_type">{{ __('messages.asset_type') }}</label>
                        <input type="text" class="form-control" name="asset_type">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="site_id">{{ __('messages.site') }}</label>
                        <select id="defaultSelect" class="form-select" name="site_id">
                            <option selected disabled>-- {{ __('messages.select_site') }}--</option>
                                @foreach(App\Site::all()->sortBy('site_name') as $site)
                                <option value="{{$site->id}}">{{$site->site_name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="asset_kewpa">{{ __('messages.asset_kewpa') }}</label>
                        <input type="text" class="form-control" name="asset_kewpa">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="asset_seriesno">{{ __('messages.asset_seriesno') }}</label>
                        <input type="text" class="form-control" name="asset_seriesno">
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">{{ __('messages.submit') }}</button>
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('equipments.allasset') }}">{{ __('messages.cancel') }}</a>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection