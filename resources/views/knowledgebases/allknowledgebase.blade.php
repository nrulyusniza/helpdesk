@extends('layouts.template')
@section('title', 'Knowledge Base List')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.mydashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('knowledgebases.allknowledgebase') }}">Knowledge Management</a>
        </li>
        <li class="breadcrumb-item active">Knowledge Base</li>
    </ol>
</nav>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="col-12">
    <div class="card">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Knowledge Base List</h4>
            <div class="btn-text-right">
                <a href="{{ route('knowledgebases.create') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; New Knowledge Base</button>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Tittle</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($knowledgebases as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $b->kbcategory->kb_category ?? " " }}</td>
                            <td>{{ $b->kb_topic }}</td>
                            <td>{{ $b->kb_article }}</td>
                            <td>
                                <form action="{{ route('knowledgebases.destroy',$b->id) }}" method="POST">
                                    <a class="menu-icon tf-icons bx bx-edit" href="{{ route('knowledgebases.edit',$b->id) }}"></a>                
                                    @csrf
                                    @method('DELETE')                    
                                    <a type="submit" class="menu-icon tf-icons bx bx-trash" style="color:#ff0000" onclick="confirmation(event)"></a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>                    
                </table>
            </div>
        </div>

    </div>
</div>

@endsection