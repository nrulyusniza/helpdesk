@extends('layouts.template')
@section('title', 'Reporting Person List')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.dashboardadmin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('reportingpersons.rpadmin') }}">User Management</a>
        </li>
        <li class="breadcrumb-item active">Reporting Person</li>
    </ol>
</nav>

<!-- Bordered Table rows -->
<div class="col-12">
    <div class="card">
        
        <!-- Top Card -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Reporting Person List</h4>
            <div class="btn-text-right">
                <a href="{{ route('reportingpersons.rpadmincreate') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; New Reporting Person</button>
                </a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <!-- Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Phone Number</th>
                            <th>Site</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($reportingpersons as $rp)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rp->rptpers_name }}</td>
                            <td>{{ $rp->rptpers_mobile }}</td>
                            <td>{{ $rp->site->site_name ?? " " }}</td>
                            <td>
                                <form action="{{ route('reportingpersons.rpadmindestroy',$rp->id) }}" method="POST">
                                    <a class="menu-icon tf-icons bx bx-edit" href="{{ route('reportingpersons.rpadminedit',$rp->id) }}"></a>                
                                    @csrf
                                    @method('DELETE')                    
                                    <a type="submit" class="menu-icon tf-icons bx bx-trash" style="color:#ff0000" onclick="confirmation(event)"></a>
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
<!--/ Bordered Table -->

@endsection