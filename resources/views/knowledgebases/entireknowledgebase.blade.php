@extends('layouts.template')
@section('title', 'Knowledge Base List')
@section('content')

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
                <a href="{{ route('knowledgebases.entireknowledgebasecreate') }}"
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
                            <th>Title</th>
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
                                    <a class="menu-icon tf-icons bx bx-edit" href="{{ route('knowledgebases.entireknowledgebaseedit',$b->id) }}"></a>                
                                    @csrf
                                    @method('DELETE')
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