@extends('layouts.template')
@section('title', 'Edit Consumable')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.mydashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tickets.allconsumable') }}">Issue Tracking</a>
        </li>
        <li class="breadcrumb-item active">Consumable</li>
    </ol>
</nav>

<div class="col-12">
    <div class="card">
        
        <!-- Title -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Update Consumable : {{ $ticket->ticket_no }}</h4>
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
            <div class="row">
                <!-- disabled consumable information -->
                <div class="col-xl">
                    <div class="card mb-4" style="background-color: #f4f3ee;">
                        <div class="card-body">                            
                            <div class="mb-3">
                                <label class="form-label" for="site_name">Site</label>
                                <input type="text" class="form-control" name="site_name" value="{{ $ticket->issue->site->site_name }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="reported_by">Reported By</label>
                                <input type="text" class="form-control" name="reported_by" value="{{ $ticket->issue->reported_by }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone_no">Phone Number (Reported By)</label>
                                <input type="text" class="form-control" name="phone_no" value="{{ $ticket->issue->phone_no }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="req_category">Category</label>
                                <input type="text" class="form-control" name="req_category" value="{{ $ticket->issue->reqcategory->req_category }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status_label">Status</label>
                                <input type="text" class="form-control" name="status_label" value="{{ $ticket->issue->status->status_label }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Equipment [x]</label>
                                <select id="defaultSelect" class="form-select" name="asset_hostname">
                                    <option selected disabled>-- Select Equipment --</option>
                                        @foreach(App\Equipment::all() as $equipment)
                                        <option value="{{ $equipment->asset_hostname .'-'. $equipment->asset_type }}">{{ $equipment->asset_hostname }} - {{ $equipment->asset_type }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="attachment">Attachment [x]</label>
                                <input type="file" class="form-control" name="attachment" value="{{ $ticket->issue->attachment }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="fault_description">Fault Description</label>
                                <textarea class="form-control" name="fault_description" rows="5" disabled>{{ $ticket->issue->fault_description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ticket log new record -->
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('tickets.allconsumableupdate',$ticket->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="site_name">Ticket Status [Ticket log] [x]</label>
                                    <select id="defaultSelect" class="form-select" name="ticstatus_label">
                                        <option selected disabled>-- Select Status --</option>
                                            @foreach(App\Ticstatus::all() as $ticstatus)
                                            <option value="{{ $ticstatus->ticstatus_label }}">{{ $ticstatus->ticstatus_label }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Comments [x]</label>
                                    <textarea class="form-control" name="" rows="5"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Response Date [x]</label>
                                    <input type="date" class="form-control" name="" value="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Response Time [x]</label>
                                    <input type="time" class="form-control" name="" value="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="req_category">Response Type [x]</label>
                                    <select id="defaultSelect" class="form-select" name="response_type">
                                        <option selected disabled>-- Select Status --</option>
                                            @foreach(App\Reaction::all() as $reaction)
                                            <option value="{{ $reaction->response_type }}">{{ $reaction->response_type }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="">Attachment [x]</label>
                                    <input type="file" class="form-control" name="" value="">
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('tickets.allconsumable') }}">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                

            <!-- text divider -->
            <div class="divider">
                <div class="divider-text">
                    <i class="bx bx-cross"></i>
                </div>
            </div>

            <h4 class="mb-0 text-primary">Ticket Log</h4><br>
                
            <!-- Hoverable Table rows -->
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Update By</th>
                                    <th>Response Type</th>
                                    <th>Response Date</th>
                                    <th>Response Time</th>
                                    <th>Attachment</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            @foreach($ticket->ticketlog as $log)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->date->format('M d, Y') }}</td>
                                    <td>{{ $log->description }}</td>
                                    <td>{{ $log->update_by }}</td>
                                    <td>{{ $log->reaction->response_type }}</td>
                                    <td>{{ $log->response_date->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse ($log->response_time)->format('h:i A') }}</td> <!-- format in 12-hour format -->
                                    <td>{{ $log->attachment }}</td>
                                    <td>{{ $log->ticstatus->ticstatus_label }}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Hoverable Table rows -->
            
        </div>
    </div>
</div>

@endsection