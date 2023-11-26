@extends('layouts.template')
@section('title', 'Site List')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.mydashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('sites.allsite') }}">Asset & Site Management</a>
        </li>
        <li class="breadcrumb-item active">Site</li>
    </ol>
</nav>

<!-- Bordered Table rows -->
<div class="col-12">
    <div class="card">
        
        <!-- Top Card -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Site List</h4>
            <div class="btn-text-right">
                <a href="{{ route('sites.create') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; New Site</button>
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
                            <th>Name</th>
                            <th>Address</th>
                            <th>Abbreviation</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($sites as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->site_name }}</td>
                            <td>{{ $s->site_address }}</td>
                            <td>{{ $s->site_abbreviation }}</td>
                            <td>
                                <form action="{{ route('sites.destroy',$s->id) }}" method="POST">
                                    <a class="menu-icon tf-icons bx bx-edit" href="{{ route('sites.edit',$s->id) }}"></a>                
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