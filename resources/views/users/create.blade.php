@extends('layouts.template')
@section('title', 'New User')
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
            <h4 class="m-0 font-weight-bold text-primary">New User</h4>
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
            <form action="{{ route('users.store') }}" method="POST">
            @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Full Name</label>
                    <div class="col-sm-10">
                        <!-- <input type="text" class="form-control" name="fullname"> -->
                        <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>

                        @error('fullname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Username</label>
                    <div class="col-sm-10">
                        <!-- <input type="text" class="form-control" name="username"> -->
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>                
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Password
                        <span style="text-transform:capitalize;">[Default: P@ssW0rdx123]</span>
                    </label>
                    <div class="col-sm-10">
                        <!-- <input
                            name="password"
                            class="form-control"
                            type="text"
                            id="exampleFormControlReadOnlyInput1"
                            required value="P@ssW0rdx123"
                            placeholder=""/> -->
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-message">Site</label>
                    <div class="col-sm-10">
                        <select id="defaultSelect" class="form-select" name="site_name">
                            <option selected disabled>-- Select Site--</option>
                                @foreach(App\Site::all() as $site)
                                <option value="{{$site->id}}">{{$site->site_name}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-message">Role</label>
                    <div class="col-sm-10">
                        <select id="defaultSelect" class="form-select" name="role_name">
                            <option selected disabled>-- Select Role--</option>
                                @foreach(App\Role::all() as $role)
                                <option value="{{$role->id}}">{{$role->role_name}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>                
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" href="{{ route('users.index') }}">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection