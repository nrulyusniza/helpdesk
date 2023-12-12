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
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="rptpers_name">Full Name</label>
                        <input type="text" class="form-control" name="rptpers_name" value="{{ $reportingperson->rptpers_name }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="rptpers_mobile">Phone Number</label>
                        <input type="text" class="form-control" name="rptpers_mobile" value="{{ $reportingperson->rptpers_mobile }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="site_id">Site</label>
                        <select id="defaultSelect" class="form-select" name="site_id">
                            @foreach(App\Site::all()->sortBy('site_name') as $site)
                                @if(auth()->user()->site_id == $site->id)                                    
                                    <option value="{{ $site->id }}" selected>{{ $site->site_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a type="cancel" class="btn btn-outline-secondary" href="{{ route('reportingpersons.listreportingperson') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection