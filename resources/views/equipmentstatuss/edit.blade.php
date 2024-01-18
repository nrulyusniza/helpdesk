@extends('layouts.template')
@section('title', 'Edit Equipment Status')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.mydashboard') }}">{{ __('messages.sm_dashboard') }}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('myextension') }}">{{ __('messages.sm_ext') }}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('equipmentstatuss.allequipmentstatus') }}">{{ __('messages.equipment_status') }}</a>
        </li>
    </ol>
</nav>

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
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.edit_eqs') }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('equipmentstatuss.update',$equipmentstatus->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="assetstatus_label">{{ __('messages.equipment_status') }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="assetstatus_label" value="{{ $equipmentstatus->assetstatus_label}}">
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                        <a class="btn btn-outline-secondary" href="{{ route('equipmentstatuss.allequipmentstatus') }}">{{ __('messages.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection