@extends('layouts.template')
@section('title', 'User List')
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

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

<div class="col-12">
  <div class="card">
        
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold text-primary">User List</h4>
      <div class="btn-text-right">
          <a href="{{ route('users.create') }}"
              <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; New User</button>
          </a>
      </div>
    </div>

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
              <th>Action</th>
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

@stop

@section('scriptlibraries')

  <!-- DataTables JS -->
  <!-- for Copy, Excel, PDF, Print & Search & Show N entries & Sorting & Showing N to N of N entries & Pagination --> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.js"></script>

  <script>
    $(document).ready(function(){
      $('#example').DataTable({
          pagingType: 'simple_numbers',
          lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],          
          responsive:true,
          dom: '<"html5buttons"B>frltip',
          buttons: [
              {extend: 'copy'},
              //{extend: 'csv'},
              {extend: 'excel', title: 'User List', exportOptions: {
                  columns: [ 0, 1, 2, 3, 4 ]}
              },
              {extend: 'pdf', title: 'User List', exportOptions: {
                  columns: [ 0, 1, 2, 3, 4 ]}
              },
              {extend: 'print', exportOptions: {
                  columns: [ 0, 1, 2, 3, 4 ]
                  },
                  customize: function (win){
                      $(win.document.body).addClass('white-bg');
                      $(win.document.body).css('font-size', '10px');
                      $(win.document.body).find('table')
                      .addClass('compact')
                      .css('font-size', 'inherit');
                  }
              }
          ]
      });
    });
  </script>

  <!-- AweetAlert JS (Delete a Row) -->
  <script>
    function confirmation(ev) {
      // prevent the default behavior of the event
      ev.preventDefault();

      // get the URL to redirect to from the closest form element
      var urlToRedirect = ev.currentTarget.closest('form').getAttribute('action');
      console.log(urlToRedirect);

      // show a confirmation dialog using the SweetAlert library
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      }).then((willCancel) => {
          // if the user confirms the deletion
          if (willCancel) {
              // create a form dynamically
              var form = document.createElement("form");
              form.setAttribute("method", "POST");
              form.setAttribute("action", urlToRedirect);
              form.setAttribute("style", "display:none");

              // add a CSRF token field to the form
              var csrfField = document.createElement("input");
              csrfField.setAttribute("type", "hidden");
              csrfField.setAttribute("name", "_token");
              csrfField.setAttribute("value", "{{ csrf_token() }}");

              // add a method field to the form with value 'DELETE'
              var methodField = document.createElement("input");
              methodField.setAttribute("type", "hidden");
              methodField.setAttribute("name", "_method");
              methodField.setAttribute("value", "DELETE");

              // append the form to the body, and append the fields to the form
              document.body.appendChild(form);
              form.appendChild(csrfField);
              form.appendChild(methodField);

              // submit the form to perform the DELETE request
              form.submit();
          }
      });
    }
  </script>

@stop  
