@extends('layouts.template')
@section('title', 'Edit Consumable')
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
            <h4 class="m-0 font-weight-bold text-primary">Ticket Number: {{ $ticket->ticket_no }}</h4>
        </div>

        <div class="card-body">            
            <div class="row">
                <!-- readonly consumable information -->                                   
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="site_name">Site</label>
                    <input type="text" class="form-control" name="site_name" value="{{ $ticket->issue->site->site_name }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="reported_by">Reported By</label>
                    <input type="text" class="form-control" name="reported_by" value="{{ $ticket->issue->reported_by }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="phone_no">Phone Number (Reported By)</label>
                    <input type="text" class="form-control" name="phone_no" value="{{ $ticket->issue->phone_no }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="attachment">Attachment [x]</label>
                    <input type="file" class="form-control" name="attachment" value="{{ $ticket->issue->attachment }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="req_category">Category</label>
                    <input type="text" class="form-control" name="req_category" value="{{ $ticket->issue->reqcategory->req_category }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">Equipment [x]</label>
                    <select id="defaultSelect" class="form-select" name="asset_hostname">
                        <option selected disabled>-- Select Equipment --</option>
                            @foreach(App\Equipment::all() as $equipment)
                            <option value="{{ $equipment->asset_hostname .'-'. $equipment->asset_type }}">{{ $equipment->asset_hostname }} - {{ $equipment->asset_type }}</option>
                            @endforeach
                    </select>
                </div>    
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="create_date">Date [x]</label>
                    <input type="date" class="form-control" name="create_date" value="{{ $ticket->create_date }}" readonly>
                </div>            
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="fault_description">Fault Description</label>
                    <textarea class="form-control" name="fault_description" rows="5" readonly>{{ $ticket->issue->fault_description }}</textarea>
                </div>
                <div class="mt-2">
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('tickets.listconsumable') }}">Back</a>
                </div>                        
            </div>
                

            <!-- text divider -->
            <div class="divider">
                <div class="divider-text">
                    <i class="bx bx-cross"></i>
                </div>
            </div>

            <h4 class="mb-0 text-primary">Ticket Log</h4><br>
                
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
            
        </div>
        
    </div>
</div>

@endsection