@extends('layouts.template')
@section('title', 'Edit User')
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
            <h4 class="m-0 font-weight-bold text-primary">Edit User</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('users.update',$user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="fullname">Full Name</label>
                        <input type="text" class="form-control" name="fullname" value="{{ $user->fullname }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="site_id">Site</label>
                        <select id="defaultSelect" class="form-select" name="site_id">
                            <option selected disabled>-- Select Site --</option>
                                @foreach(App\Site::all()->sortBy('site_name') as $site)
                                <option value="{{ $site->id }}" {{ $site->id == $user->site_id ? 'selected' : '' }}>{{ $site->site_name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="role_id">Role</label>
                        <select id="defaultSelect" class="form-select" name="role_id">
                            <option selected disabled>-- Select Role --</option>
                                @foreach(App\Role::all() as $role)
                                <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="username">Password
                            <span style="text-transform:capitalize;">[Default: P@ssW0rdx123]</span>
                        </label>
                            <input type="password" class="form-control" name="password" value="{{ $user->password }}" readonly>
                    </div>
                    <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a class="btn btn-outline-secondary" href="{{ route('users.alluser') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection