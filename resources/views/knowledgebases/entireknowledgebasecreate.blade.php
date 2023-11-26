@extends('layouts.template')
@section('title', 'New Knowledge Base')
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
        <!-- Title -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">New Knowledge Base</h4>
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
            <form action="{{ route('knowledgebases.entireknowledgebasestore') }}" method="POST">
            @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Category</label>
                    <div class="col-sm-10">
                        <select id="defaultSelect" class="form-select" name="kb_category">
                            <option selected disabled>-- Select Category --</option>
                                @foreach(App\Kbcategory::all()->sortBy('kb_category') as $kbcategory)
                                <option value="{{$kbcategory->id}}">{{$kbcategory->kb_category}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kb_title">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Content</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" type="text" name="kb_content"></textarea>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-outline-secondary" href="{{ route('knowledgebases.entireknowledgebase') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection