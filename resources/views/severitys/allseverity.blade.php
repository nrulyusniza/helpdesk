@extends('layouts.template')
@section('title', 'Severity List')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.mydashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('myextension') }}">Extension</a>
        </li>
        <li class="breadcrumb-item active">Severity</li>
    </ol>
</nav>

<!-- Bordered Table rows -->
<div class="col-12">
    <div class="card">
        
        <!-- Top Card -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Severity List</h4>
            <div class="btn-text-right">
                <a href="{{ route('severitys.create') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; New Severity</button>
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Severity</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($severitys as $st)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $st->severity_label }}</td>
                            <td>
                                <form action="{{ route('severitys.destroy',$st->id) }}" method="POST">
                                    <a class="menu-icon tf-icons bx bx-edit" href="{{ route('severitys.edit',$st->id) }}"></a>                
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