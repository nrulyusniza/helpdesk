@extends('layouts.template')
@section('title', 'Edit Knowledge Base')
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
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.edit_knowledgebase') }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('knowledgebases.listknowledgebaseupdate',['knowledgebase' => $knowledgebase->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="kb_category">{{ __('messages.kb_category') }}</label>
                        <select id="defaultSelect" class="form-select" name="kb_category">
                            <option selected disabled>-- {{ __('messages.kb_selectcategory') }} --</option>
                                @foreach(App\Kbcategory::all()->sortBy('kb_category') as $kbcategory)
                                <option value="{{ $kbcategory->id }}" {{ $kbcategory->id == $knowledgebase->kb_category ? 'selected' : '' }}>{{ $kbcategory->kb_category }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="kb_topic">{{ __('messages.kb_title') }}</label>
                            <input type="text" class="form-control" name="kb_topic" value="{{ $knowledgebase->kb_topic }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="kb_article">{{ __('messages.kb_content') }}</label>
                        <textarea class="form-control" name="kb_article" rows="10">{{ $knowledgebase->kb_article }}</textarea>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">{{ __('messages.update') }}</button>
                        <a type="cancel" class="btn btn-outline-secondary" href="{{ route('knowledgebases.listknowledgebase') }}">{{ __('messages.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection