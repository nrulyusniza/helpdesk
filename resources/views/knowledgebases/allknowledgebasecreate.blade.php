@extends('layouts.template')
@section('title', 'New Knowledge Base')
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
            <h4 class="m-0 font-weight-bold text-primary">New Knowledge Base</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('knowledgebases.allknowledgebasestore') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                    <label class="form-label" for="kb_category">Category</label>
                        <select id="defaultSelect" class="form-select" name="kb_category">
                            <option selected disabled>-- Select Category --</option>
                                @foreach(App\Kbcategory::all()->sortBy('kb_category') as $kbcategory)
                                <option value="{{$kbcategory->id}}">{{$kbcategory->kb_category}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="kb_topic">Title</label>
                        <input type="text" class="form-control" name="kb_topic">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="kb_article">Content</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" type="text" name="kb_article"></textarea>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a type="cancel" class="btn btn-outline-secondary" href="{{ route('knowledgebases.allknowledgebase') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection