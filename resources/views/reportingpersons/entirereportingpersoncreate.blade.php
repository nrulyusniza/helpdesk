@extends('layouts.template')
@section('title', 'New Reporting Person')
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
            <h4 class="m-0 font-weight-bold text-primary">New Reporting Person</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('reportingpersons.entirereportingpersonstore') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="rptpers_name">Full Name</label>
                        <input type="text" class="form-control" name="rptpers_name">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="rptpers_mobile">Phone Number</label>
                        <input type="text" class="form-control" name="rptpers_mobile">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="site_id">Site [x]</label>
                        <select id="defaultSelect" class="form-select" name="site_id">
                            <option selected disabled>-- Select Site --</option>
                                @foreach(App\Site::all()->sortBy('site_name') as $site)
                                <option value="{{$site->id}}">{{$site->site_name}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('reportingpersons.entirereportingperson') }}">Cancel</a>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection