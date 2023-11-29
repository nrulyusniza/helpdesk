@extends('layouts.template')
@section('title', 'Consumable List')
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="col-12">
    <div class="card">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Consumable List</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Report Date</th>
                            <th>Request No [DB]</th>
                            <th>Ticket No</th>
                            <!-- <th>Ticket Type</th> -->
                            <th>Site</th>
                            <th>Fault Description</th>
                            <!-- <th>Admin Comments</th> -->
                            <th>Equipment</th>
                            <th>Severity</th>
                            <th>Status</th>                            
                            <!-- <th>Created By</th>
                            <th>Create Date</th>
                            <th>Update By</th>
                            <th>Update Date</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($tickets as $tt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tt->report_received->format('M d, Y') }}</td>
                            <td>{{ $tt->request_id }}</td>
                            <td>{{ $tt->ticket_no }}</td>
                            <!-- <td>{{ $tt->type->request_type }}</td> -->
                            <td>{{ $tt->issue->site->site_name ?? " " }}</td>
                            <td>{{ $tt->issue->fault_description ?? " " }}</td>
                            <!-- <td>{{ $tt->issue->admin_comments ?? " " }}</td> -->
                            <td>{{ $tt->issue->equipment->asset_hostname ?? " " }} - {{ $tt->issue->equipment->asset_type ?? " " }}</td>
                            <td>{{ $tt->severity->severity_label ?? " " }}</td>
                            <td>{{ $tt->ticstatus->ticstatus_label ?? " " }}</td>                            
                            <!-- <td>{{ $tt->user->fullname ?? " " }}</td>
                            <td>{{ $tt->create_date->format('M d, Y') }}</td>
                            <td>{{ $tt->user->fullname ?? " " }}</td>
                            <td>{{ $tt->update_date->format('M d, Y') }}</td> -->
                            <td>
                                <form action="" method="POST">
                                    <a class="menu-icon tf-icons bx bx-edit" href="{{ route('tickets.allconsumableedit',$tt->id) }}"></a>
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>                    
                </table>
            </div>
        </div>
        
    </div>
</div>

@endsection