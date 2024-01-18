@extends('layouts.template')
@section('title', 'New User Group')
@section('content')

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
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.new_usergroup') }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">{{ __('messages.name') }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="role_name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-message">{{ __('messages.description') }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="role_desc">
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                        <a class="btn btn-secondary" href="{{ route('roles.index') }}">{{ __('messages.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection