@extends('layouts.template')
@section('title', 'Edit Consumable & Ticket Log')
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

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="col-12">
    <div class="card">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Update Consumable : {{ $ticket->ticket_no }}</h4>
            <div class="btn-text-right">
                <a href="{{ route('dashboard.infohub.allticket') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-tachometer'></i>&nbsp; Back to Dashboard</button>
                </a>
            </div>
        </div>

        <div class="card-body">            
            <div class="row">
                <!-- readonly consumable information -->
                <div class="col-xl">
                    <div class="card mb-4" style="background-color: #f4f3ee;">
                        <div class="card-body">  
                            <div class="mb-3">
                                <label class="form-label" for="ticket_type">Ticket type</label>
                                <input type="text" class="form-control" name="ticket_type" value="{{ $ticket->issue->type->request_type }}" readonly>
                            </div>                          
                            <div class="mb-3">
                                <label class="form-label" for="site_name">Site</label>
                                <input type="text" class="form-control" name="site_name" value="{{ $ticket->issue->site->site_name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="rptpers_name">Reported By</label>
                                <input type="text" class="form-control" name="rptpers_name" value="{{ $ticket->issue->reportingperson->rptpers_name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone_no">Phone Number (Reported By)</label>
                                <input type="number" class="form-control" name="phone_no" value="{{ $ticket->issue->phone_no }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="req_category">Category</label>
                                <input type="text" class="form-control" name="req_category" value="{{ $ticket->issue->reqcategory->req_category }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status_label">Status</label>
                                <input type="text" class="form-control" name="status_label" value="{{ $ticket->issue->status->status_label }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="asset_hostname">Equipment</label>
                                <input type="text" class="form-control" name="asset_hostname" value="{{ $ticket->issue->equipment->asset_hostname }} - {{ $ticket->issue->equipment->asset_type }}" readonly>
                            </div> 
                            <div class="mb-3">
                                <label class="form-label" for="attachment">Attachment [x]</label>
                                <input type="file" class="form-control" name="attachment" value="{{ $ticket->issue->attachment }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="fault_description">Fault Description</label>
                                <textarea class="form-control" name="fault_description" rows="5" readonly>{{ $ticket->issue->fault_description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ticket log new record -->
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('tickets.allconsumableupdate',['ticket' => $ticket->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="ticstatus_id">Current Ticket Status</label>
                                    <select id="defaultSelect" class="form-select" name="ticstatus_id">
                                        <option selected readonly>-- Select Status --</option>
                                            @foreach(App\Ticstatus::all() as $ticstatus)
                                            <option value="{{ $ticstatus->id }}">{{ $ticstatus->ticstatus_label }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="description">Comments</label>
                                    <textarea class="form-control" name="description" rows="5" name="description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="response_date">Response Date</label>
                                    <input type="date" class="form-control" name="response_date" value="response_date">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="response_time">Response Time</label>
                                    <input type="time" class="form-control" name="response_time" value="response_time">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="reaction_id">Response Type</label>
                                    <select id="defaultSelect" class="form-select" name="reaction_id">
                                        <option selected readonly>-- Select Status --</option>
                                            @foreach(App\Reaction::all() as $reaction)
                                            <option value="{{ $reaction->id }}">{{ $reaction->response_type }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="attachment">Attachment</label>
                                    <input class="form-control" type="file" name="attachment" id="formFile" />
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

            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Received Date</th>
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
                                    <td>{{ $log->date->format('M d, Y h:i A') }}</td>
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