@extends('layouts.template')
@section('title', 'Edit Request')
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
            <h4 class="m-0 font-weight-bold text-primary">Update Request : {{ $issue->request_no }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('issues.allresponseupdate',$issue->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- information -->
                    <div class="col-xl">
                        <div class="card mb-4" style="background-color: #f4f3ee;">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="request_type">Request Type</label>
                                    <input type="text" class="form-control" name="request_type" value="{{ $issue->type->request_type }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="site_name">Site</label>
                                    <input type="text" class="form-control" name="site_name" value="{{ $issue->site->site_name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="rptpers_name">Reported By</label>
                                    <input type="text" class="form-control" name="rptpers_name" value="{{ $issue->reportingperson->rptpers_name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="phone_no">Phone Number (Reported By)</label>
                                    <input type="number" class="form-control" name="phone_no" value="{{ $issue->phone_no }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="req_category">Category</label>
                                    <input type="text" class="form-control" name="req_category" value="{{ $issue->reqcategory->req_category }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="status_label">Status</label>
                                    <input type="text" class="form-control" name="status_label" value="{{ $issue->status->status_label }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="asset_hostname">Equipment</label>
                                    <input type="text" class="form-control" name="asset_hostname" value="{{ $issue->equipment->asset_hostname }} - {{ $issue->equipment->asset_type }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="attachment">Attachment</label><br>
                                    <!-- <input type="text" class="form-control" name="attachment" value="{{ $issue->attachment }}" readonly> -->
                                    @if ($issue->attachment)
                                        <a href="{{ $issue->attachment }}" target="_blank">{{ basename($issue->attachment) }}</a>
                                    @else
                                        <p>No attachment available</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="fault_description">Fault Description</label>
                                    <textarea class="form-control" name="fault_description" rows="5" readonly>{{ $issue->fault_description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="created_by">Created By [x]</label>
                                    <input type="text" class="form-control" name="created_by" value="{{ $issue->created_by }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="create_date">Create Date</label>
                                    <input type="text" class="form-control" name="create_date" value="{{ $issue->create_date->format('M d, Y') }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="mb-0 text-primary">Admin Response</h5><br>
                                <div class="mb-3">
                                    <label class="form-label" for="admin_comments">Admin Comments</label>
                                    <textarea class="form-control" name="admin_comments" rows="5">{{ $issue->admin_comments }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="severity_id">Severity</label>
                                    <select id="defaultSelect" class="form-select" name="severity_id">
                                        <option selected disabled>-- Select Severity --</option>
                                            @foreach(App\Severity::all() as $severity)
                                                <option value="{{$severity->id}}">{{$severity->severity_label}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="updated_by">Updated By [x]</label>
                                    <input type="text" class="form-control" name="updated_by">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="update_date">Update Date [x]</label>
                                    <input type="date" class="form-control" name="update_date">
                                </div> 
                                <div class="mb-3">
                                    <label class="form-label">Status [x]</label>
                                    <!-- <input type="date" class="form-control" name="update_date"> -->
                                    <div class="col-md">
                                        <div class="form-check">
                                            <input
                                            name="default-radio-1"
                                            class="form-check-input"
                                            type="radio"
                                            value=""
                                            id="defaultRadio2"
                                            checked />
                                            <label class="form-check-label" for="defaultRadio2"> Create Ticket </label>
                                        </div>
                                        <div class="form-check mt-3">
                                            <input
                                            name="default-radio-1"
                                            class="form-check-input"
                                            type="radio"
                                            value=""
                                            id="defaultRadio1" />
                                            <label class="form-check-label" for="defaultRadio1"> Ammend </label>
                                        </div>
                                        <div class="form-check mt-3">
                                            <input
                                            name="default-radio-1"
                                            class="form-check-input"
                                            type="radio"
                                            value=""
                                            id="defaultRadio1" />
                                            <label class="form-check-label" for="defaultRadio1"> Rejected </label>
                                        </div> 
                                    </div>
                                </div> 
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Update</button>
                                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('issues.allissue') }}">Cancel</a>
                                </div>
                            </div>                            
                        </div>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>

@endsection