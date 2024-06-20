@extends('layouts.template')
@section('title', 'Consumable List')
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="col-12">
    <div class="card">
        
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.consumable_list') }}</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('messages.report_date') }}</th>
                            <th>{{ __('messages.request_no') }}</th>
                            <th>{{ __('messages.ticket_no') }}</th>
                            <!-- <th>Ticket Type</th> -->
                            <th>{{ __('messages.site') }}</th>
                            <th>{{ __('messages.fault_desc') }}</th>
                            <!-- <th>Admin Comments</th> -->
                            <th>{{ __('messages.equipment') }}</th>
                            <th>{{ __('messages.severity') }}</th>
                            <th>{{ __('messages.current_status') }}</th>                                 
                            <!-- <th>Created By</th>
                            <th>Create Date</th>
                            <th>Update By</th>
                            <th>Update Date</th> -->
                            <th>{{ __('messages.action') }}</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($tickets as $tt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tt->report_received->format('d/m/Y') }}</td>
                            <td>{{ $tt->issue->request_no }}</td>
                            <td>{{ $tt->ticket_no }}</td>
                            <!-- <td>{{ $tt->type->request_type }}</td> -->
                            <td>{{ $tt->issue->site->site_name ?? " " }}</td>
                            <td>{{ $tt->issue->fault_description ?? " " }}</td>
                            <!-- <td>{{ $tt->issue->admin_comments ?? " " }}</td> -->
                            <td>{{ $tt->issue->equipment->asset_hostname ?? " " }} - {{ $tt->issue->equipment->asset_type ?? " " }}</td>
                            <!-- <td>{{ $tt->severity->severity_label ?? " " }}</td> -->
                            <td>
                                @if(isset($tt->severity->severity_label))
                                    @php
                                        $severityLabel = $tt->severity->severity_label;
                                        $badgeClass = '';

                                        switch($tt->severity->id) {
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
                            <!-- <td>{{ $tt->ticstatus->ticstatus_label ?? " " }}</td> -->
                            <td>
                                @if(null !== ($latestTicketlog = $tt->latestTicketlog))
                                    @php
                                        $badgeClass = '';

                                        switch($latestTicketlog->ticstatus->id ?? null) {
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
                                            default:
                                                $badgeClass = 'bg-label-info';
                                                break;
                                        }
                                    @endphp

                                    <span class="badge {{ $badgeClass }} me-1">{{ $latestTicketlog->ticstatus->ticstatus_label }}</span>
                                @else
                                    {{-- display ticstatus_id=1 (New Ticket) badge when there are no ticketlog records --}}
                                    @php
                                        $badgeClass = 'bg-success'; // Set the badge class for ticstatus_id=1
                                    @endphp
                                    <span class="badge {{ $badgeClass }} me-1">{{ $tt->ticstatus->ticstatus_label ?? 'Default Label' }}</span>
                                @endif
                            </td>   <!-- badges that depends on database -->    
                            <td>
                                <form action="" method="POST">
                                    <!--<a class="menu-icon tf-icons bx bx-expand-alt" href="{{ route('tickets.listconsumablelog',$tt->id) }}"></a> -->
                                    <a class="menu-icon tf-icons bx bx-archive" href="{{ route('tickets.listconsumablelog',$tt->id) }}" style="color:#57cc99"
                                        data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                        title="<span>{{ __('messages.details_ticket_log') }}</span>"></a>
                                    @csrf
                                    @method('DELETE')                    
                                    <!-- <a type="submit" class="menu-icon tf-icons bx bx-trash" style="color:#ff0000"></a> -->
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
                {extend: 'excel', title: 'Consumable List', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]}
                },
                {extend: 'pdf', title: 'Consumable List', exportOptions: {
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