@extends('layouts.template')
@section('title', 'Request List')
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="col-12">
    <div class="card">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.request_list') }}</h4>
            <div class="btn-text-right">
                <a href="{{ route('issues.allissuecreate') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; {{ __('messages.new_request') }}</button>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('messages.request_no') }}</th>
                            <th>{{ __('messages.request_type') }}</th>
                            <!-- <th>{{ __('messages.reported_by') }}</th> -->
                            <th>{{ __('messages.report_date') }}</th>
                            <th>{{ __('messages.site') }}</th>
                            <th>{{ __('messages.asset') }}</th>
                            <th>{{ __('messages.category') }}</th>
                            <th>{{ __('messages.status') }}</th>
                            <!-- <th>{{ __('messages.user') }}</th> -->
                            <th>{{ __('messages.action') }}</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($issues as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $i->request_no }}</td>
                            <td>{{ $i->type->request_type }}</td>
                            <!-- <td>{{ $i->reportingperson->rptpers_name }}</td> -->
                            <!-- <td>{{ $i->create_date->format('d/m/Y') }}</td> 0000-00-00, in result  -0001 -->
                            <td>{{ optional($i->create_date)->format('d/m/Y') }}</td>
                            <td>{{ $i->site->site_name ?? " " }}</td>
                            <td>{{ $i->equipment->asset_hostname ?? " " }} - {{ $i->equipment->asset_type ?? " " }}</td>
                            <td>{{ $i->reqcategory->req_category ?? " " }}</td>                            
                            <td class="text-center align-middle">
                                @if(isset($i->status->status_label))
                                    @php
                                        $statusLabel = $i->status->status_label;
                                        $badgeClass = '';

                                        switch($i->status->id) {
                                            case 1:
                                                $badgeClass = 'bg-success';
                                                break;
                                            case 2:
                                                $badgeClass = 'bg-primary';
                                                break;
                                            case 3:
                                                $badgeClass = 'bg-dark';
                                                break;
                                            case 4:
                                                $badgeClass = 'bg-danger';
                                                break;
                                            case 5:
                                                $badgeClass = 'bg-warning';
                                                break;
                                            default:
                                                $badgeClass = 'bg-label-info';
                                                break;
                                        }
                                    @endphp

                                    <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                                        <span class="badge {{ $badgeClass }} me-1" style="white-space: normal; max-width: 100px; word-wrap: break-word; line-height: 1.0; padding: 5px;">
                                            {{ $statusLabel }}
                                        </span>
                                    </div>
                                    <!-- <span class="badge {{ $badgeClass }} me-1" style="white-space: normal; max-width: 100px; word-wrap: break-word; line-height: 1.0; padding: 5px;">{{ $statusLabel }}</span> -->
                                @else
                                    <span class="badge bg-secondary me-1"></span>
                                @endif
                            </td>   <!-- badges that depends on database -->
                            <!-- <td>
                                @php
                                    // $i->created_by is the username of the user who created the issue
                                    $creator = \App\User::where('username', $i->created_by)->first();
                                    $creatorFullname = $creator ? $creator->fullname : 'Unknown';
                                @endphp
                                {{ $creatorFullname }}
                            </td> -->
                            <td>
                                <form action="{{ route('issues.destroy',$i->id) }}" method="POST">
                                    <a class="menu-icon tf-icons bx bx-detail" href="{{ route('issues.allissuedetail',['issue' => $i->id]) }}"
                                        data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                        title="<span>{{ __('messages.view_details') }}</span>"></a>
                                    <a class="menu-icon tf-icons bx bx-edit" href="{{ route('issues.allresponse',['issue' => $i->id]) }}" style="color:#ffd60a"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                    title="<span>{{ __('messages.admin_response') }}</span>"></a>
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
                {extend: 'excel', title: 'Request List', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]}
                },
                {extend: 'pdf', title: 'Request List', exportOptions: {
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