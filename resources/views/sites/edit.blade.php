@extends('layouts.template')
@section('title', 'Edit Site')
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
            <h4 class="m-0 font-weight-bold text-primary">Edit Site</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('sites.update',$site->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="site_name">Name</label>
                        <input type="text" class="form-control" name="site_name" value="{{ $site->site_name }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="site_abbreviation">Abbreviation</label>
                        <input type="text" class="form-control" name="site_abbreviation" value="{{ $site->site_abbreviation }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="site_address">Address</label>
                        <textarea class="form-control" name="site_address" rows="5">{{ $site->site_address }}</textarea>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('sites.allsite') }}">Cancel</a>
                </div>                
            </form>
        </div>
        
    </div>
</div>

@endsection