@extends('layouts.template')
@section('title', 'Asset List')
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
                            <th>Origin Location</th>
                            <th>Asset Type</th>
                            <th>Kewpa</th>
                            <th>Series No.</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($equipments->sortBy('asset_hostname') as $e)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $e->asset_hostname }}</td>
                            <td>{{ $e->asset_location }}</td>
                            <td>{{ $e->asset_type }}</td>
                            <td>{{ "Kewpa" }}</td>
                            <td>{{ "Series No" }}</td>
                            <td>{{ "Status" }}</td>
                            <td>
                                <form action="{{ route('equipments.destroy',$e->id) }}" method="POST">
                                    <a class="menu-icon tf-icons bx bx-expand-alt" href="{{ route('equipments.entireassetlog',$e->id) }}"></a>
                                    @csrf
                                    @method('DELETE')
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