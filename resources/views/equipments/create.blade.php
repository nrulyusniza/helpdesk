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
            <h4 class="m-0 font-weight-bold text-primary">New Asset</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('equipments.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Hostname</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_hostname">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Location</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_location">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset IP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_ip">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Type</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_type">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-message">Site</label>
                    <div class="col-sm-10">
                        <select id="defaultSelect" class="form-select" name="site_name">
                            <option selected disabled>-- Select Site--</option>
                                @foreach(App\Site::all() as $site)
                                <option value="{{$site->id}}">{{$site->site_name}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Kewpa</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_kewpa">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_status">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Location</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_location">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Series No.</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_seriesno">
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('equipments.index') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection