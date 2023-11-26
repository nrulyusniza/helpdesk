@extends('layouts.template')
@section('title', 'Edit Asset')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.mydashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('equipments.allasset') }}">Asset & Site Management</a>
        </li>
        <li class="breadcrumb-item active">Asset</li>
    </ol>
</nav>

<div class="col-12">
    <div class="card">

        <!-- Title -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Edit Asset</h4>
        </div>

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

        <!-- Forms -->
        <div class="card-body">
            <form action="{{ route('equipments.update',$equipment->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Hostname</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_hostname" value="{{ $equipment->asset_hostname }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Location</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_location" value="{{ $equipment->asset_location }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset IP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_ip" value="{{ $equipment->asset_ip }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Type</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_type" value="{{ $equipment->asset_type }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Site</label>
                    <div class="col-sm-10">
                        <select id="defaultSelect" class="form-select" name="site_name">
                            <option selected disabled>-- Select Site --</option>
                                @foreach(App\Site::all() as $site)
                                <!-- <option value="{{$site->id}}">{{$site->site_name}}</option> -->
                                <option value="{{ $site->id }}" {{ $site->id == $equipment->site_id ? 'selected' : '' }}>{{ $site->site_name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Kewpa</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_kewpa" value="{{ $equipment->asset_kewpa }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_status" value="{{ $equipment->asset_status }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Location</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_location" value="{{ $equipment->asset_location }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Asset Series No.</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_seriesno" value="{{ $equipment->asset_seriesno }}">
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a class="btn btn-secondary" href="{{ route('equipments.index') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection