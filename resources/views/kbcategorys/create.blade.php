@extends('layouts.template')
@section('title', 'New Knowledge Base Category')
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
            <a href="{{ route('kbcategorys.allkbcategory') }}">{{ __('messages.category_kb') }}</a>
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
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.new_kbc') }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('kbcategorys.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="kb_category">{{ __('messages.kbc') }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kb_category">
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                        <a class="btn btn-outline-secondary" href="{{ route('kbcategorys.allkbcategory') }}">{{ __('messages.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection