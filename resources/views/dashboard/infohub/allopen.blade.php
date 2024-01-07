@extends('layouts.template')
@section('title', 'All Open Tickets')
@section('content')

<div class="col-xl-12">
    <div class="nav-align-top mb-4">

        <ul class="nav nav-tabs nav-fill" role="tablist">
            <li class="nav-item">
                <a href="{{ route('dashboard.infohub.allticket') }}" class="nav-link {{ request()->routeIs('dashboard.infohub.allticket') ? 'active' : '' }}">
                    <i class="tf-icons bx bx-card me-1"></i> Tickets
                    <span class="badge badge-center h-px-20 w-px-20 bg-warning ms-1">{{ $allTicCount }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.infohub.allopen') }}" class="nav-link {{ request()->routeIs('dashboard.infohub.allopen') ? 'active' : '' }}">
                    <i class="tf-icons bx bx-lock-open me-1"></i> Open
                    <span class="badge badge-center h-px-20 w-px-20 bg-warning ms-1">{{ $allOpenCount }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.infohub.allclosed') }}" class="nav-link {{ request()->routeIs('dashboard.infohub.allclosed') ? 'active' : '' }}">
                    <i class="tf-icons bx bx-lock me-1"></i> Closed
                    <span class="badge badge-center h-px-20 w-px-20 bg-warning ms-1">{{ $allClosedCount }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.infohub.allkiv') }}" class="nav-link {{ request()->routeIs('dashboard.infohub.allkiv') ? 'active' : '' }}">
                    <i class="tf-icons bx bx-archive me-1"></i> KIV
                    <span class="badge badge-center h-px-20 w-px-20 bg-warning ms-1">{{ $allKivCount }}</span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" role="tabpanel">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Report Date</th>
                                    <th>Request No</th>
                                    <th>Ticket No</th>
                                    <th>Ticket Type</th>
                                    <th>Site</th>
                                    <th>Fault Description</th>
                                    <!-- <th>Admin Comments</th> -->
                                    <th>Equipment</th>
                                    <th>Severity</th>
                                    <!-- <th>Status</th> -->
                                    <!-- <th>Created By</th>
                                    <th>Create Date</th>
                                    <th>Update By</th>
                                    <th>Update Date</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>                    
                            <tbody class="table-border-bottom-0">
                                @foreach ($allOpen as $aot)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $aot->report_received->format('M d, Y') }}</td>
                                    <td>{{ $aot->issue->request_no }}</td>
                                    <td>{{ $aot->ticket_no }}</td>
                                    <td>{{ $aot->type->request_type }}</td>
                                    <td>{{ $aot->issue->site->site_name ?? " " }}</td>
                                    <td>{{ $aot->issue->fault_description ?? " " }}</td>
                                    <!-- <td>{{ $aot->issue->admin_comments ?? " " }}</td> -->
                                    <td>{{ $aot->issue->equipment->asset_hostname ?? " " }} - {{ $aot->issue->equipment->asset_type ?? " " }}</td>
                                    <!-- <td>{{ $aot->severity->severity_label ?? " " }}</td> -->
                                    <td>
                                        @if(isset($aot->severity->severity_label))
                                            @php
                                                $severityLabel = $aot->severity->severity_label;
                                                $badgeClass = '';

                                                switch($aot->severity->id) {
                                                    case 1:
                                                        $badgeClass = 'bg-danger';
                                                        break;
                                                    case 2:
                                                        $badgeClass = 'bg-primary';
                                                        break;
                                                    case 3:
                                                        $badgeClass = 'bg-success';
                                                        break;
                                                    default:
                                                        $badgeClass = 'bg-label-info';
                                                        break;
                                                }
                                            @endphp

                                            <span class="badge {{ $badgeClass }} me-1">{{ $severityLabel }}</span>
                                        @else
                                            <span class="badge bg-secondary me-1"></span>
                                        @endif
                                    </td>   <!-- badges that depends on database -->  
                                    <td>
                                        <form action="" method="POST">
                                            @php
                                                $routeName = ($aot->type->id == 1) ? 'tickets.allticketedit' : 'tickets.allconsumableedit';
                                            @endphp

                                            <a class="menu-icon tf-icons bx bx-archive" href="{{ route($routeName, $aot->id) }}" style="color:#57cc99"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                title="<span>Details Ticket Log</span>"></a>
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
                {extend: 'excel', title: 'All Open Ticket List', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]}
                },
                {extend: 'pdf', title: 'All Open Ticket List', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]}
                },
                {extend: 'print', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
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