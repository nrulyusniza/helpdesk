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
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.update_request') }} : {{ $issue->request_no }}</h4>
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
                                    <label class="form-label" for="request_type">{{ __('messages.request_type') }}</label>
                                    <input type="text" class="form-control" name="request_type" value="{{ $issue->type->request_type }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="site_name">{{ __('messages.site') }}</label>
                                    <input type="text" class="form-control" name="site_name" value="{{ $issue->site->site_name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="rptpers_name">{{ __('messages.reported_by') }}</label>
                                    <input type="text" class="form-control" name="rptpers_name" value="{{ $issue->reportingperson->rptpers_name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="phone_no">{{ __('messages.phone_number') }}</label>
                                    <input type="number" class="form-control" name="phone_no" value="{{ $issue->phone_no }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="req_category">{{ __('messages.category') }}</label>
                                    <input type="text" class="form-control" name="req_category" value="{{ $issue->reqcategory->req_category }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="status_label">{{ __('messages.status') }}</label>
                                    <input type="text" class="form-control" name="status_label" value="{{ $issue->status->status_label }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="asset_hostname">{{ __('messages.equipment') }}</label>
                                    <input type="text" class="form-control" name="asset_hostname" value="{{ $issue->equipment->asset_hostname }} - {{ $issue->equipment->asset_type }}" readonly>
                                </div>
                                <div class="mb-3">
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
                                <div class="mb-3">
                                    <label class="form-label" for="created_by">{{ __('messages.created_by') }}</label>
                                    @php
                                        // $issue->created_by is the username of the user who created the issue
                                        $creator = \App\User::where('username', $issue->created_by)->first();
                                        $creatorFullname = $creator ? $creator->fullname : 'Unknown';
                                    @endphp
                                    <input type="text" class="form-control" name="created_by" value="{{ $creatorFullname }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="create_date">{{ __('messages.create_date') }}</label>
                                    <input type="text" class="form-control" name="create_date" value="{{ $issue->create_date->format('M d, Y') }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="mb-0 text-primary">{{ __('messages.admin_response') }}</h5><br>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('messages.status') }}</label>
                                    <div class="col-md">
                                        @if ($issue->request_type == 1)
                                            <div class="form-check">
                                                <input
                                                    name="status-radio"
                                                    class="form-check-input"
                                                    type="radio"
                                                    value="2"
                                                    id="createTicketRadio"
                                                    {{ $issue->request_type == 1 ? 'checked' : '' }}
                                                />
                                                <label class="form-check-label" for="createTicketRadio"> {{ __('messages.create_ticket') }} </label>
                                            </div>
                                        @endif
                                        @if ($issue->request_type == 2)
                                            <div class="form-check mt-3">
                                                <input
                                                    name="status-radio"
                                                    class="form-check-input"
                                                    type="radio"
                                                    value="3"
                                                    id="createConsumableRadio"
                                                    {{ $issue->request_type == 2 ? 'checked' : '' }}
                                                />
                                                <label class="form-check-label" for="createConsumableRadio"> {{ __('messages.create_consumable') }} </label>
                                            </div>
                                        @endif
                                        <div class="form-check mt-3">
                                            <input
                                            name="status-radio"
                                            class="form-check-input"
                                            type="radio"
                                            value="4"
                                            id="rejectedRadio" />
                                            <label class="form-check-label" for="rejectedRadio"> {{ __('messages.rejected') }} </label>                                            
                                        </div>
                                        <div class="form-check mt-3">
                                            <input
                                            name="status-radio"
                                            class="form-check-input"
                                            type="radio"
                                            value="5"
                                            id="ammendRadio" />
                                            <label class="form-check-label" for="ammendRadio"> {{ __('messages.ammend') }} </label>
                                        </div> 
                                    </div>
                                </div> 
                                <!-- <div class="mb-3">
                                    <label class="form-label" for="admin_comments">{{ __('messages.admin_comments') }}</label>
                                    @if ($issue->request_type == 1)
                                    <textarea class="form-control" name="admin_comments" rows="5">{{ $issue->admin_comments }}</textarea>
                                    @endif
                                    @if ($issue->request_type == 2)
                                    @endif
                                </div> -->
                                <div class="mb-3" id="admin-comments-box">
                                    <label class="form-label" for="admin_comments">{{ __('messages.admin_comments') }}</label>
                                    <textarea class="form-control" name="admin_comments" id="admin_comments" rows="5">{{ $issue->admin_comments }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="severity_id">{{ __('messages.severity') }}</label>
                                    <select id="defaultSelect" class="form-select" name="severity_id">
                                        <option selected disabled>-- {{ __('messages.select_severity') }} --</option>
                                            @foreach(App\Severity::all()->sortByDesc('id') as $severity) 
                                                <option value="{{$severity->id}}">{{$severity->severity_label}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="update_date">{{ __('messages.update_date') }}</label>
                                    <input type="date" class="form-control" name="update_date" value="{{ \Carbon\Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d') }}">
                                </div>                                 
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">{{ __('messages.update') }}</button>
                                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('issues.allissue') }}">{{ __('messages.cancel') }}</a>
                                </div>
                            </div>                            
                        </div>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>

@stop

@section('scriptlibraries')

<script>
    // Admin comments box
    document.addEventListener('DOMContentLoaded', function () {
        const statusRadios = document.querySelectorAll('input[name="status-radio"]');
        const adminCommentsBox = document.getElementById('admin-comments-box');
        const adminCommentsTextarea = document.getElementById('admin_comments');

        // To toggle the visibility and required status_id of the admin comments box
        function toggleAdminCommentsBox() {
            // Get the value of the selected radio button
            const selectedValue = document.querySelector('input[name="status-radio"]:checked').value;

            // If the selected value status_id = 2 (Ticket Created), 
            // status_id = 3 (Consumable Created), 
            // status_id = 4 (Rejected), status_id = 5 (Ammend)
            if (selectedValue == 2) {
                adminCommentsBox.style.display = 'block';   // Show the admin comments box
                adminCommentsTextarea.required = false;     // Set the required admin_comments of the textarea to false
            } else if (selectedValue == 3) {
                adminCommentsBox.style.display = 'none';    // Hide the admin comments box
                adminCommentsTextarea.required = false;     // Set the required admin_comments of the textarea to false
            } else if (selectedValue == 4 || selectedValue == 5) {
                adminCommentsBox.style.display = 'block';   // Show the admin comments box
                adminCommentsTextarea.required = true;      // Set the required admin_comments of the textarea to true
            }
        }

        // Add an event listener to each radio button to call the toggle function when changed
        statusRadios.forEach(radio => {
            radio.addEventListener('change', toggleAdminCommentsBox);
        });

        // Call the toggle function once on page load to set the initial state (refresh)
        toggleAdminCommentsBox();
    });
</script>

@stop