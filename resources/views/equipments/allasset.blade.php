@extends('layouts.template')
@section('title', 'Asset List')
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

<!-- Bordered Table rows -->
<div class="col-12">
    <div class="card">
        
        <!-- Top Card -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Asset List</h4>
            <div class="btn-text-right">
                <a href="{{ route('equipments.create') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; New Asset</button>
                </a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <!-- Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hostname</th>
                            <th>Current Location</th>
                            <!-- <th>IP</th> -->
                            <th>Asset Type</th>
                            <th>Site</th>
                            <!-- <th>Kewpa</th> -->
                            <th>Status</th>
                            <!-- <th>Origin</th> -->
                            <!-- <th>Series No.</th> -->
                            <th width="150px">Action</th>
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
                            <td>{{ $e->site->site_name ?? "-" }}</td>
                            <!-- <td>{{ "Kewpa" }}</td> -->
                            <td>{{ "Status" }}</td>
                            <!-- <td>{{ "Origin" }}</td> -->
                            <!-- <td>{{ "Series No" }}</td> -->
                            <td>
                                <form action="{{ route('equipments.destroy',$e->id) }}" method="POST">
                                    <a class="menu-icon tf-icons bx bx-edit" href="{{ route('equipments.edit',$e->id) }}"></a>                
                                    @csrf
                                    @method('DELETE')                    
                                    <a type="submit" class="menu-icon tf-icons bx bx-trash" style="color:#ff0000" onclick="confirmation(event)"></a>
                                </form>
                            </td>
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