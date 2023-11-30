@extends('layouts.template')
@section('title', 'Request Type List')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.mydashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('myextension') }}">Extension</a>
        </li>
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
            <h4 class="m-0 font-weight-bold text-primary">Request Type List</h4>
            <div class="btn-text-right">
                <a href="{{ route('types.create') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; New Request Type</button>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Request Type</th>
                        <th>Action</th>
                    </tr>
                </thead>                
                <tbody class="table-border-bottom-0">
                    @foreach ($types as $ty)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ty->request_type }}</td>
                        <td>
                            <form action="{{ route('types.destroy',$ty->id) }}" method="POST">
                                <a class="menu-icon tf-icons bx bx-edit" href="{{ route('types.edit',$ty->id) }}"></a>                
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

@endsection