@extends('layouts.template')
@section('title', 'Ticket Reporting')
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="col-12">
    <div class="card">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Ticket Reporting</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Report Date</th>
                            <th>Request No</th>
                            <th>Ticket No</th>
                            <th>Site</th>
                            <th>Fault Description</th>
                            <th>Admin Comments</th>
                            <th>Asset</th>
                            <th>Severity</th>
                            <th>Status</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($tickets as $tt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tt->report_received->format('M d, Y') }}</td>
                            <td>{{ $tt->issue->request_no ?? " " }}</td>
                            <td>{{ $tt->ticket_no }}</td>
                            <td>{{ $tt->issue->site->site_name ?? " " }}</td>
                            <td>{{ $tt->issue->fault_description ?? " " }}</td>
                            <td>{{ $tt->issue->admin_comments ?? " " }}</td>
                            <td>{{ $tt->issue->equipment->asset_hostname ?? " " }}</td>
                            <td>{{ $tt->severity->severity_label ?? " " }}</td>
                            <td>{{ $tt->ticstatus->ticstatus_label ?? " " }}</td>
                        </tr>
                        @endforeach
                    </tbody>                    
                </table>
            </div>
        </div>
        
    </div>
</div>

@endsection