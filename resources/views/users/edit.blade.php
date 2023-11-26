@extends('layouts.template')
@section('title', 'Edit User')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.mydashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('users.alluser') }}">User Management</a>
        </li>
        <li class="breadcrumb-item active">User</li>
    </ol>
</nav>

<div class="col-12">
    <div class="card">

        <!-- Title -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Edit User</h4>
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
            <form action="{{ route('users.update',$user->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="fullname" value="{{ $user->fullname }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Site</label>
                    <div class="col-sm-10">
                        <select id="defaultSelect" class="form-select" name="site_name">
                            <option selected disabled>-- Select Site --</option>
                                @foreach(App\Site::all() as $site)
                                <option value="{{ $site->id }}" {{ $site->id == $user->site_id ? 'selected' : '' }}>{{ $site->site_name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Role</label>
                    <div class="col-sm-10">
                        <select id="defaultSelect" class="form-select" name="role_name">
                            <option selected disabled>-- Select Role --</option>
                                @foreach(App\Role::all() as $role)
                                <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Password
                        <span style="text-transform:capitalize;">[Default: P@ssW0rdx123]</span>
                    </label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" value="{{ $user->password }}">
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a class="btn btn-secondary" href="{{ route('users.index') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection