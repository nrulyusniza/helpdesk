@extends('layouts.template')
@section('title', 'Edit Knowledge Base')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.dashboarduser') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('knowledgebases.entireknowledgebase') }}">Knowledge Management</a>
        </li>
        <li class="breadcrumb-item active">Knowledge Base</li>
    </ol>
</nav>

<div class="col-12">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Knowledge Base</h5>

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

        </div>
        <div class="card-body">
            <form action="{{ route('knowledgebases.entireknowledgebaseupdate',$knowledgebase->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Category</label>
                    <div class="col-sm-10">
                        <select id="defaultSelect" class="form-select" name="kb_category">
                            <option selected disabled>-- Select Category --</option>
                                @foreach(App\Kbcategory::all() as $kbcategory)
                                <!-- <option value="{{$kbcategory->id}}">{{$kbcategory->kb_category}}</option> -->
                                <option value="{{ $kbcategory->id }}" {{ $kbcategory->id == $knowledgebase->kb_category ? 'selected' : '' }}>{{ $kbcategory->kb_category }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kb_title" value="{{ $knowledgebase->kb_topic }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Content</label>
                    <div class="col-sm-10">
                        <!-- <input type="text" class="form-control" name="kb_content" value="{{ $knowledgebase->kb_article }}"> -->
                        <textarea class="form-control" name="" rows="5">{{ $knowledgebase->kb_article }}</textarea>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a class="btn btn-outline-secondary" href="{{ route('knowledgebases.entireknowledgebase') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection