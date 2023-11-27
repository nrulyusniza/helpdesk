@extends('layouts.template')
@section('title', 'Edit Knowledge Base')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.dashboardadmin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('knowledgebases.listknowledgebase') }}">Knowledge Management</a>
        </li>
        <li class="breadcrumb-item active">Knowledge Base</li>
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
            <h4 class="m-0 font-weight-bold text-primary">Edit Knowledge Base</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('knowledgebases.listknowledgebaseupdate',$knowledgebase->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="kb_category">Category</label>
                        <select id="defaultSelect" class="form-select" name="kb_category">
                            <option selected disabled>-- Select Category --</option>
                                @foreach(App\Kbcategory::all() as $kbcategory)
                                <option value="{{ $kbcategory->id }}" {{ $kbcategory->id == $knowledgebase->kb_category ? 'selected' : '' }}>{{ $kbcategory->kb_category }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="kb_title">Title</label>
                            <input type="text" class="form-control" name="kb_title" value="{{ $knowledgebase->kb_topic }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="kb_content">Content</label>
                        <input type="text" class="form-control" name="kb_content" value="{{ $knowledgebase->kb_article }}">
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a type="cancel" class="btn btn-outline-secondary" href="{{ route('knowledgebases.listknowledgebase') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection