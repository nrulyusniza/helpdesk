@extends('layouts.template')
@section('title', 'Asset Log')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.dashboarduser') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('equipments.entireasset') }}">Asset & Site Management</a>
        </li>
        <li class="breadcrumb-item active">Asset</li>
    </ol>
</nav>

<div class="col-12">
    <div class="card">
        
        <!-- Title -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Asset Details: </h4>
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
            <div class="row">
                <!-- asset information -->                                   
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="asset_hostname">Hostname</label>
                    <input type="text" class="form-control" name="asset_hostname" value="{{ $e->asset_hostname }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="asset_location">Location</label>
                    <input type="text" class="form-control" name="asset_location" value="{{ $e->asset_location }}" disabled>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="asset_ip">IP</label>
                    <input type="text" class="form-control" name="asset_ip" value="{{ $e->asset_ip }}">
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="asset_type">Asset Type</label>
                    <input type="text" class="form-control" name="asset_type" value="{{ $e->asset_type }}">
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="asset_type">Site</label>
                    <select id="defaultSelect" class="form-select" name="site_name">
                        <option selected disabled>-- Select Site --</option>
                            @foreach(App\Site::all()->sortBy('site_name') as $site)
                            <!-- <option value="{{$site->id}}">{{$site->site_name}}</option> -->
                            <option value="{{ $site->id }}" {{ $site->id == $e->site_id ? 'selected' : '' }}>{{ $site->site_name }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="asset_kewpa">Kewpa</label>
                    <input type="text" class="form-control" name="asset_kewpa" value="{{ $e->asset_kewpa }}">
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="asset_status">Status</label>
                    <input type="text" class="form-control" name="asset_status" value="{{ $e->asset_status }}">
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="asset_status">Location</label>
                    <input type="text" class="form-control" name="asset_status" value="{{ $e->asset_location }}">
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="asset_seriesno">Series No.</label>
                    <input type="text" class="form-control" name="asset_seriesno" value="{{ $e->asset_seriesno }}">
                </div>
                <div class="mt-2">
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('tickets.entireasset') }}">Back</a>
                </div>                        
            </div>
                

            <!-- text divider -->
            <div class="divider">
                <div class="divider-text">
                    <i class="bx bx-cross"></i>
                </div>
            </div>

            <h4 class="mb-0 text-primary">Asset Log</h4><br>
                
            <!-- Hoverable Table rows -->
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hostname</th>
                                    <th>Current Location</th>
                                    <th>IP</th>
                                    <th>Asset Type</th>
                                    <th>Site</th>
                                    <th>Kewpa</th>
                                    <th>Status</th>
                                    <th>Origin</th>
                                    <th>Series No.</th>
                                </tr>
                            </thead>
                            @foreach($equipments->sortBy('asset_hostname') as $e)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $e->asset_hostname }}</td>
                                    <td>{{ $e->asset_location }}</td>
                                    <td>{{ $e->asset_ip }}</td>
                                    <td>{{ $e->asset_type }}</td>
                                    <td>{{ $e->site->site_name ?? "-" }}</td>
                                    <!-- <td>{{ "Kewpa" }}</td>
                                    <td>{{ "Status" }}</td>
                                    <td>{{ "Origin" }}</td>
                                    <td>{{ "Series No" }}</td> -->
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Hoverable Table rows -->
            
        </div>
    </div>
</div>

@endsection