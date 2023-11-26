@extends('layouts.template')
@section('title', 'User List')
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

<!-- Cards User -->
<div class="row g-4 mb-4">

  <!-- 1 -->
  <div class="col-sm-6 col-xl-3">
    <a href="">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">Total Users</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $totalUsers }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-primary">
                <i class="bx bx-user bx-sm"></i>

              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 2 -->
  <div class="col-sm-6 col-xl-3">
    <a href="">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">Super Admin</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $totalSuperAdmin }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-success">
                <i class="bx bx-user bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 3 -->
  <div class="col-sm-6 col-xl-3">
    <a href="">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">Site Admin</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $totalSiteAdmin }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-success">
                <i class="bx bx-user bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 4 -->
  <div class="col-sm-6 col-xl-3">
    <a href="">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">Site User</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $totalSiteUser }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-success">
                <i class="bx bx-user bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

</div>

<!-- Bordered Table rows -->
<div class="col-12">
    <div class="card">
        
        <!-- Top Card -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">User List</h4>
            <div class="btn-text-right">
                <a href="{{ route('users.create') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; New User</button>
                </a>
            </div>
        </div>   

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <!-- Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Site</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                      @foreach ($users as $u)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $u->username }}</td>
                        <td>{{ $u->fullname }}</td>
                        <td>{{ $u->role->role_name ?? " " }}</td>
                        <td>{{ $u->site->site_name ?? " " }}</td>
                        <td>
                          <form action="{{ route('users.destroy',$u->id) }}" method="POST">
                            <a class="menu-icon tf-icons bx bx-edit" href="{{ route('users.edit',$u->id) }}"></a>                
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
<!--/ Bordered Table -->

@endsection   
