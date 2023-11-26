@extends('layouts.template')
@section('title', 'New Reporting Person')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.dashboardadmin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('reportingpersons.rpadmin') }}">User Management</a>
        </li>
        <li class="breadcrumb-item active">Reporting Person</li>
    </ol>
</nav>

<div class="col-12">
    <div class="card">

        <!-- Title -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">New Reporting Person</h4>
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
            <form action="{{ route('reportingpersons.rpadminstore') }}" method="POST">
            @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="rptpers_name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="rptpers_mobile">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-message">Site</label>
                    <div class="col-sm-10">
                        <select id="defaultSelect" class="form-select" name="site_name" disabled>                            
                                @foreach(App\Site::all() as $site)
                                <option value="{{$site->id}}">{{$site->site_name}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('reportingpersons.rpadmin') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection