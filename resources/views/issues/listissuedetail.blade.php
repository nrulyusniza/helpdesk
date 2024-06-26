@extends('layouts.template')
@section('title', 'Issue Details')
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
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.details_request') }} : {{ $issue->request_no }}</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 mb-4 mb-xl-0">
                    <div class="demo-inline-spacing mt-3">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-danger">
                                <i class="bx bx-pin me-2"></i>
                                    {{ __('messages.modify') }}.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">            
            <div class="row">
                <!-- issue information -->                                   
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="request_type">{{ __('messages.request_type') }}</label>
                    <input type="text" class="form-control" name="request_type" value="{{ $issue->type->request_type }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="site_name">{{ __('messages.site') }}</label>
                    <input type="text" class="form-control" name="site_name" value="{{ $issue->site->site_name }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="rptpers_name">{{ __('messages.reported_by') }}</label>
                    <input type="text" class="form-control" name="rptpers_name" value="{{ $issue->reportingperson->rptpers_name }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="phone_no">{{ __('messages.phone_number') }}</label>
                    <input type="number" class="form-control" name="phone_no" value="{{ $issue->phone_no }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="req_category">{{ __('messages.category') }}</label>
                    <input type="text" class="form-control" name="req_category" value="{{ $issue->reqcategory->req_category }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="status_label">{{ __('messages.status') }}</label>
                    <input type="text" class="form-control" name="status_label" value="{{ $issue->status->status_label }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="asset_hostname">{{ __('messages.equipment') }}</label>
                    <input type="text" class="form-control" name="asset_hostname" value="{{ $issue->equipment->asset_hostname }} - {{ $issue->equipment->asset_type }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="attachment">{{ __('messages.attachment') }}</label><br>
                    <!-- <input type="text" class="form-control" name="attachment" value="{{ $issue->attachment }}" readonly> -->
                    @if ($issue->attachment)
                        <!-- <a href="{{ $issue->attachment }}" target="_blank">{{ basename($issue->attachment) }}</a> -->
                        <a href="{{ asset('storage/' . $issue->attachment) }}" target="_blank">{{ __('messages.view_attachment') }}</a>
                    @else
                        <p>{{ __('messages.no_attachment') }}</p>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="fault_description">{{ __('messages.fault_desc') }}</label>
                    <textarea class="form-control" name="fault_description" rows="5" readonly>{{ $issue->fault_description }}</textarea>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="created_by">{{ __('messages.created_by') }}</label>
                    @php
                        // $issue->created_by is the username of the user who created the issue
                        $creator = \App\User::where('username', $issue->created_by)->first();
                        $creatorFullname = $creator ? $creator->fullname : 'Unknown';
                    @endphp
                    <input type="text" class="form-control" name="created_by" value="{{ $creatorFullname }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="create_date">{{ __('messages.create_date') }}</label>
                    <input type="text" class="form-control" name="create_date" value="{{ $issue->create_date->format('d/m/Y') }}" readonly>
                </div>                       
            </div>
                
            <!-- text divider -->
            <div class="divider">
                <div class="divider-text">
                    <i class="bx bx-cross"></i>
                </div>
            </div>

            <h4 class="mb-0 text-primary">{{ __('messages.admin_response') }}</h4><br>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="admin_comments">{{ __('messages.admin_comments') }}</label>
                    <textarea class="form-control" name="admin_comments" rows="5" readonly>{{ $issue->admin_comments }}</textarea>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="severity_label">{{ __('messages.severity') }}</label>
                    <input type="text" class="form-control" name="severity_label" value="{{ $issue->severity->severity_label }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="updated_by">{{ __('messages.updated_by') }}</label>
                    @php
                        // $issue->updated_by is the username of the user who updated the issue
                        $updater = \App\User::where('username', $issue->updated_by)->first();
                        $updaterFullname = $updater ? $updater->fullname : ' ';
                    @endphp
                    <input type="text" class="form-control" name="updated_by" value="{{ $updaterFullname }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="update_date">{{ __('messages.update_date') }}</label>
                    <input type="text" class="form-control" name="update_date" value="{{ $issue->update_date instanceof \Carbon\Carbon ? $issue->update_date->format('d/m/Y') : '' }}" readonly>
                </div>  
                <div class="mt-2">
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('issues.listissue') }}">{{ __('messages.back') }}</a>
                </div>               
            </div>
        </div>
        
    </div>
</div>

@endsection