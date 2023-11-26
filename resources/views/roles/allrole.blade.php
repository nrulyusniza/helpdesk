@extends('layouts.template')
@section('title', 'User Group List')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.mydashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('roles.allrole') }}">User Management</a>
        </li>
        <li class="breadcrumb-item active">User Group</li>
    </ol>
</nav>

<!-- Bordered Table rows -->
<div class="col-12">
    <div class="card">
        
        <!-- Top Card -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">User Group List</h4>
            <div class="btn-text-right">
                <a href="{{ route('roles.create') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; New User Group</button>
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
                            <th>Description</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($roles as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r->role_name }}</td>
                            <td>{{ $r->role_desc }}</td>
                            <td>
                                <!--
                                <form action="{{ route('roles.destroy',$r->id) }}" method="POST">
                                    <a class="btn btn-primary" href="{{ route('roles.edit',$r->id) }}">Edit</a>                
                                    @csrf
                                    @method('DELETE')                    
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                -->
                                <form action="{{ route('roles.destroy',$r->id) }}" method="POST">
                                    <a class="menu-icon tf-icons bx bx-edit" href="{{ route('roles.edit',$r->id) }}"></a>                
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