@extends('layouts.template')
@section('title', 'Edit Reporting Person')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.dashboarduser') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('reportingpersons.entirereportingperson') }}">User Management</a>
        </li>
        <li class="breadcrumb-item active">Reporting Person</li>
    </ol>
</nav>

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
            <h4 class="m-0 font-weight-bold text-primary">Edit Reporting Person</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('reportingpersons.entirereportingpersonupdate',$reportingperson->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-name">Full Name</label>
                        <input type="text" class="form-control" name="rptpers_name" value="{{ $reportingperson->rptpers_name }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-name">Phone Number</label>
                        <input type="text" class="form-control" name="rptpers_mobile" value="{{ $reportingperson->rptpers_mobile }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-name">Site [x]</label>
                        <select id="defaultSelect" class="form-select" name="site_name">
                            <option selected disabled>-- Select Site --</option>
                                @foreach(App\Site::all()->sortBy('site_name') as $site)
                                <option value="{{ $site->id }}" {{ $site->id == $reportingperson->site_id ? 'selected' : '' }}>{{ $site->site_name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a type="cancel" class="btn btn-outline-secondary" href="{{ route('reportingpersons.entirereportingperson') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection