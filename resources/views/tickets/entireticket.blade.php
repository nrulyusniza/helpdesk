@extends('layouts.template')
@section('title', 'Ticket List')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.mydashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('tickets.entireticket') }}">Issue Tracking</a>
        </li>
        <li class="breadcrumb-item active">Ticket</li>
    </ol>
</nav>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="col-12">
    <div class="card">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Ticket List</h4>
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
                            <th>Equipment</th>
                            <th>Severity</th>
                            <th>Status</th>
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
                            <td>{{ $tt->issue->site->site_name ?? " " }}</td>
                            <td>{{ $tt->issue->fault_description ?? " " }}</td>
                            <td>{{ $tt->issue->equipment->asset_hostname ?? " " }} - {{ $tt->issue->equipment->asset_type ?? " " }}</td>
                            <td>{{ $tt->severity->severity_label ?? " " }}</td>
                            <td>{{ $tt->ticstatus->ticstatus_label ?? " " }}</td>
                            <td>
                                <form action="" method="POST">
                                    <a class="menu-icon tf-icons bx bx-expand-alt" href="{{ route('tickets.entireticketlog',$tt->id) }}"></a>
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