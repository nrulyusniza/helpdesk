@extends('layouts.template')
@section('title', 'Edit Request')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.mydashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('issues.allissue') }}">Issue Tracking</a>
        </li>
        <li class="breadcrumb-item active">Request</li>
    </ol>
</nav>

<div class="col-12">
    <div class="card">
        
        <!-- Title -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Update Request : {{ $issue->request_no }}</h4>
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
            <form action="{{ route('issues.update',$issue->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Request Type</label>
                    <div class="col-sm-10">
                        <select id="defaultSelect" class="form-select" name="request_type">
                            <option selected disabled>-- Select Request Type --</option>
                                @foreach(App\Type::all() as $type)
                                <option value="{{$type->id}}">{{$type->request_type}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Site</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="site_name" value="{{ $issue->site->site_name }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Reported By</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reported_by" value="{{ $issue->reported_by }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Phone Number (Reported By)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone_no" value="{{ $issue->phone_no }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="status_label" value="{{ $issue->status->status_label }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Category</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="req_category" value="{{ $issue->reqcategory->req_category }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Equipment</label>
                    <div class="col-sm-10">   
                        <select id="defaultSelect" class="form-select" name="asset_hostname">
                            <option selected disabled>-- Select Equipment --</option>
                                @foreach(App\Equipment::all() as $equipment)
                                <option value="{{ $equipment->asset_hostname .'-'. $equipment->asset_type }}">{{ $equipment->asset_hostname }} - {{ $equipment->asset_type }}</option>
                                @endforeach
                        </select>                    
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Date</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="create_date" value="{{ $issue->create_date->format('M d, Y') }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Attachment</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="attachment" value="{{ $issue->attachment }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Fault Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="fault_description" value="{{ $issue->fault_description }}" readonly>
                    </div>
                </div>

                <hr class="my-5" />
                <h5 class="mb-0">Admin Response</h5><br>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Severity</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="severity_label" value="{{ $issue->severity->severity_label }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Admin Comment</label>
                    <div class="col-sm-10">
                        <!-- <input type="text" class="form-control" name="admin_comment" value="{{ $issue->admin_comment }}" readonly> -->
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" type="text" name="admin_comment" readonly></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="status_label" value="{{ $issue->status->status_label }}" readonly>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a class="btn btn-secondary" href="{{ route('issues.index') }}">Cancel</a>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

@endsection