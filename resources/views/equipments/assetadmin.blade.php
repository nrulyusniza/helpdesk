@extends('layouts.template')
@section('title', 'Asset List')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.dashboardadmin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('equipments.assetadmin') }}">Asset & Site Management</a>
        </li>
        <li class="breadcrumb-item active">Asset</li>
    </ol>
</nav>

<!-- Bordered Table rows -->
<div class="col-12">
    <div class="card">
        
        <!-- Top Card -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Asset List</h4>
            <div class="btn-text-right">
                <!-- here button (if any) -->
            </div>
        </div>

        <!-- Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hostname</th>
                            <th>Location</th>
                            <!-- <th>IP</th> -->
                            <th>Asset Type</th>
                            <!-- <th>Site</th> -->
                            <!-- <th>Kewpa</th> -->
                            <th>Status</th>
                            <th>Location</th>
                            <!-- <th>Series No.</th> -->
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($equipments as $e)
                        <tr>
                        <td>{{ $loop->iteration }}</td>
                            <td>{{ $e->asset_hostname }}</td>
                            <td>{{ $e->asset_location }}</td>
                            <!-- <td>{{ $e->asset_ip }}</td> -->
                            <td>{{ $e->asset_type }}</td>
                            <!-- <td>{{ $e->site->site_name ?? "-" }}</td> -->
                            <!-- <td>{{ "Kewpa" }}</td> -->
                            <td>{{ "Status" }}</td>
                            <td>{{ "Origin" }}</td>
                            <!-- <td>{{ "Series No" }}</td> -->
                            <td>
                        </tr>
                        @endforeach
                    </tbody>                    
                </table>
            </div>           
        </div>

    </div>
</div>
<!--/ Bordered Table -->

@endsection