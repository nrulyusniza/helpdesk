@extends('layouts.template')
@section('title', 'Ticket Reporting')
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="col-12">
    <div class="card">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.ticket_reporting') }}</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <form method="get" action="generatereport">
                    <div class="input-group">
                        <select class="form-select" name="date_filter">
                            <option value="">{{ __('messages.all_dates') }}</option>
                            <option value="today" {{ $dateFilter == 'today' ? 'selected' : '' }}>{{ __('messages.today') }}</option>
                            <option value="yesterday" {{ $dateFilter == 'yesterday' ? 'selected' : '' }}>{{ __('messages.yesterday') }}</option>
                            <option value="this_week" {{ $dateFilter == 'this_week' ? 'selected' : '' }}>{{ __('messages.this_week') }}</option>
                            <option value="last_week" {{ $dateFilter == 'last_week' ? 'selected' : '' }}>{{ __('messages.last_week') }}</option>
                            <option value="this_month" {{ $dateFilter == 'this_month' ? 'selected' : '' }}>{{ __('messages.this_month') }}</option>
                            <option value="last_month" {{ $dateFilter == 'last_month' ? 'selected' : '' }}>{{ __('messages.last_month') }}</option>
                            <option value="this_year" {{ $dateFilter == 'this_year' ? 'selected' : '' }}>{{ __('messages.this_year') }}</option>
                            <option value="last_year" {{ $dateFilter == 'last_year' ? 'selected' : '' }}>{{ __('messages.last_year') }}</option>
                            <option value="custom_date" {{ $dateFilter == 'custom_date' ? 'selected' : '' }}>{{ __('messages.custom_date') }}</option>
                        </select>
                        @if ($dateFilter == 'custom_date')
                            <input type="date" name="start_date" class="form-control" placeholder="Start Date" required>
                            <input type="date" name="end_date" class="form-control" placeholder="End Date" required>
                        @endif
                        <button type="submit" class="btn btn-primary">{{ __('messages.filter') }}</button>
                    </div>
                </form><br>
                
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('messages.report_date') }}</th>
                            <th>{{ __('messages.request_no') }}</th>
                            <th>{{ __('messages.ticket_no') }}</th>
                            <th>{{ __('messages.site') }}</th>
                            <th>{{ __('messages.fault_desc') }}</th>
                            <th>{{ __('messages.admin_comments') }}</th>
                            <th>{{ __('messages.asset') }}</th>
                            <th>{{ __('messages.severity') }}</th>
                            <th>{{ __('messages.status') }}</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($tickets as $tt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tt->report_received->format('M d, Y') }}</td>
                            <td>{{ $tt->issue->request_no ?? " " }}</td>
                            <td>{{ $tt->ticket_no }}</td>
                            <td>{{ $tt->issue->site->site_name ?? " " }}</td>
                            <td>{{ $tt->issue->fault_description ?? " " }}</td>
                            <td>{{ $tt->issue->admin_comments ?? " " }}</td>
                            <td>{{ $tt->issue->equipment->asset_hostname ?? " " }}</td>
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
                {extend: 'excel', title: 'Ticket Reporting', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]}
                },
                {extend: 'pdf', title: 'Ticket Reporting', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]}
                },
                {extend: 'print', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
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

    <!-- <script>
        $(function() {
            $("#start_date").datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $("#end_date").datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        // Fetch records
        function fetch(start_date, end_date) {
            $.ajax({
                url: "{{ route('tickets.report.generatereport') }}",
                type: "GET",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                dataType: "json",
                success: function(data) {
                    // Datatables
                    var i = 1;
                    $('#records').DataTable({
                        "data": data.students,
                        // responsive
                        "responsive": true,
                        "columns": [{
                                "data": "id",
                                "render": function(data, type, row, meta) {
                                    return i++;
                                }
                            },
                            // {
                            //     "data": "name"
                            // },
                            // {
                            //     "data": "standard",
                            //     "render": function(data, type, row, meta) {
                            //         return `${row.standard}th Standard`;
                            //     }
                            // },
                            // {
                            //     "data": "percentage",
                            //     "render": function(data, type, row, meta) {
                            //         return `${row.percentage}%`;
                            //     }
                            // },
                            // {
                            //     "data": "result"
                            // },
                            {
                                "data": "report_received",
                                "render": function(data, type, row, meta) {
                                    return moment(row.report_received).format('DD-MM-YYYY');
                                }
                            }
                        ]
                    });
                }
            });
        }
        fetch();
        // Filter
        $(document).on("click", "#filter", function(e) {
            e.preventDefault();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            if (start_date == "" || end_date == "") {
                alert("Both date required");
            } else {
                $('#records').DataTable().destroy();
                fetch(start_date, end_date);
            }
        });
        // Reset
        $(document).on("click", "#reset", function(e) {
            e.preventDefault();
            $("#start_date").val(''); // empty value
            $("#end_date").val('');
            $('#records').DataTable().destroy();
            fetch();
        });
    </script> -->

@stop