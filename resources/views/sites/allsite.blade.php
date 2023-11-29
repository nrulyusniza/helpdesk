@extends('layouts.template')
@section('title', 'Site List')
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="col-12">
    <div class="card">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Site List</h4>
            <div class="btn-text-right">
                <a href="{{ route('sites.create') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; New Site</button>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Abbreviation</th>
                            <th>Action</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($sites as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->site_name }}</td>
                            <td>{{ $s->site_address }}</td>
                            <td>{{ $s->site_abbreviation }}</td>
                            <td>
                                <form action="{{ route('sites.destroy',$s->id) }}" method="POST">
                                    <a class="menu-icon tf-icons bx bx-edit" href="{{ route('sites.edit',$s->id) }}"></a>                
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