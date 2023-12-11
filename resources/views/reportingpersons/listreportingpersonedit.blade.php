@extends('layouts.template')
@section('title', 'Edit Reporting Person')
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
            <h4 class="m-0 font-weight-bold text-primary">Edit Reporting Person</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('reportingpersons.listreportingpersonupdate',$reportingperson->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="rptpers_name" value="{{ $reportingperson->rptpers_name }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="rptpers_mobile" value="{{ $reportingperson->rptpers_mobile }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Site</label>
                    <div class="col-sm-10">
                        <select id="defaultSelect" class="form-select" name="site_name" disabled>
                            @foreach(App\Site::all() as $site)
                                @if(auth()->user()->site_id == $site->id)                                    
                                    <option value="{{ $site->id }}" selected>{{ $site->site_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a class="btn btn-secondary" href="{{ route('reportingpersons.listreportingperson') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection