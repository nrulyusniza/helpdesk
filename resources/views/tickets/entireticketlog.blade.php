@extends('layouts.template')
@section('title', 'Ticket Log')
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
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.ct_number') }} : {{ $ticket->ticket_no }}</h4>
        </div>

        <div class="card-body">            
            <div class="row">
                <!-- readonly consumable information -->
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="ticket_type">{{ __('messages.ticket_type') }}</label>
                    <input type="text" class="form-control" name="ticket_type" value="{{ $ticket->issue->type->request_type }}" readonly>
                </div>                                    
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="site_name">{{ __('messages.site') }}</label>
                    <input type="text" class="form-control" name="site_name" value="{{ $ticket->issue->site->site_name }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="rptpers_name">{{ __('messages.reported_by') }}</label>
                    <input type="text" class="form-control" name="rptpers_name" value="{{ $ticket->issue->reportingperson->rptpers_name }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="phone_no">{{ __('messages.phone_number') }}</label>
                    <input type="number" class="form-control" name="phone_no" value="{{ $ticket->issue->phone_no }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="attachment">{{ __('messages.attachment') }}</label><br>
                    <!-- <input type="file" class="form-control" name="attachment" value="{{ $ticket->issue->attachment }}" readonly> -->
                    @if ($ticket->issue->attachment)
                        <!-- <a href="{{ $ticket->issue->attachment }}" target="_blank">{{ basename($ticket->issue->attachment) }}</a> -->
                        <a href="{{ asset('storage/' . $ticket->issue->attachment) }}" target="_blank">{{ __('messages.view_attachment') }}</a>
                    @else
                        <p>{{ __('messages.no_attachment') }}</p>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="req_category">{{ __('messages.category') }}</label>
                    <input type="text" class="form-control" name="req_category" value="{{ $ticket->issue->reqcategory->req_category }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="asset_hostname">{{ __('messages.equipment') }}</label>
                    <input type="text" class="form-control" name="asset_hostname" value="{{ $ticket->issue->equipment->asset_hostname }} - {{ $ticket->issue->equipment->asset_type }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="create_date">{{ __('messages.date') }}</label>
                    <input type="text" class="form-control" name="create_date" value="{{ $ticket->create_date ? $ticket->create_date->format('d/m/Y') : 'N/A' }}" readonly>
                </div>            
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="fault_description">{{ __('messages.fault_desc') }}</label>
                    <textarea class="form-control" name="fault_description" rows="5" readonly>{{ $ticket->issue->fault_description }}</textarea>
                </div>
                <div class="mt-2">
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('tickets.entireticket') }}">{{ __('messages.back') }}</a>
                </div>                        
            </div>     

            <!-- text divider -->
            <div class="divider">
                <div class="divider-text">
                    <i class="bx bx-cross"></i>
                </div>
            </div>

            <h4 class="mb-0 text-primary">{{ __('messages.ticket_log') }}</h4><br>

            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('messages.id') }}</th>
                                    <th>{{ __('messages.date') }}</th>
                                    <th>{{ __('messages.description') }}</th>
                                    <th>{{ __('messages.update_by') }}</th>
                                    <th>{{ __('messages.response_type') }}</th>
                                    <th>{{ __('messages.response_date') }}</th>
                                    <th>{{ __('messages.response_time') }}</th>
                                    <th>{{ __('messages.attachment') }}</th>
                                    <th>{{ __('messages.status') }}</th>
                                </tr>
                            </thead>
                            @foreach($ticket->ticketlog as $log)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->date->format('d/m/Y') }}</td>
                                    <td>{{ $log->description }}</td>
                                    <td>
                                        @php
                                            // $i->update_by is the username of the user who update the issue
                                            $updater = \App\User::where('username', $log->update_by)->first();
                                            $updaterFullname = $updater ? $updater->fullname : 'Unknown';
                                        @endphp
                                        {{ $updaterFullname }}
                                    </td>
                                    <td>{{ $log->reaction->response_type }}</td>
                                    <td>{{ $log->response_date->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse ($log->response_time)->format('h:i A') }}</td> <!-- format in 12-hour format -->
                                    <!-- <td>{{ $log->attachment }}</td> -->
                                    <td>
                                        @if ($log->attachment)                                        
                                            <!-- <a href="{{ asset('storage/' . $log->attachment) }}" target="_blank">{{ __('messages.view_attachment') }}</a> -->
                                            <a class="menu-icon tf-icons bx bx-link" href="{{ asset('storage/' . $log->attachment) }}"  target="_blank" style="color:#ef476f"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                title="<span>{{ __('messages.view_attachment') }}</span>"></a>
                                        @else
                                            <p>{{ __('messages.no_attachment') }}</p>
                                        @endif                                
                                    </td>
                                    <!-- <td>{{ $log->ticstatus->ticstatus_label }}</td> -->
                                    <td>
                                        @if(isset($log->ticstatus->ticstatus_label))
                                            @php
                                                $ticstatusLabel = $log->ticstatus->ticstatus_label;
                                                $badgeClass = '';

                                                switch($log->ticstatus->id) {
                                                    case 1:
                                                        $badgeClass = 'bg-success';
                                                        break;
                                                    case 2:
                                                        $badgeClass = 'bg-primary';
                                                        break;
                                                    case 3:
                                                        $badgeClass = 'bg-dark';
                                                        break;
                                                    case 4:
                                                        $badgeClass = 'bg-danger';
                                                        break;
                                                    default:
                                                        $badgeClass = 'bg-label-info';
                                                        break;
                                                }
                                            @endphp

                                            <span class="badge {{ $badgeClass }} me-1">{{ $ticstatusLabel }}</span>
                                        @else
                                            <span class="badge bg-secondary me-1"></span>
                                        @endif
                                    </td>   <!-- badges that depends on database --> 
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