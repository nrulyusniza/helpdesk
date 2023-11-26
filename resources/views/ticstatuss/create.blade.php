@extends('layouts.template')
@section('title', 'New Ticket Status')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.mydashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('myextension') }}">Extension</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('ticstatuss.allticstatus') }}">Ticket Status</a>
        </li>
        <li class="breadcrumb-item active">New Ticket Status</li>
    </ol>
</nav>

<div class="col-12">
    <div class="card">

        <!-- Title -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">New Ticket Status</h4>
        </div>

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

        <!-- Forms -->
        <div class="card-body">
            <form action="{{ route('ticstatuss.store') }}" method="POST">
            @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Ticket Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ticstatus_label">
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('ticstatuss.index') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection