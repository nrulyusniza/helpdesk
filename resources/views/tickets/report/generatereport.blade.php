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

                <form method="get" action="producereport">
                    <div class="input-group">
                        <select class="form-select" name="date_filter" id="dateFilter">
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
                        <!-- @if ($dateFilter == 'custom_date') -->
                            <input type="date" id="startDate" name="start_date" class="form-control" placeholder="Start Date" style="display: none;" required>
                            <input type="date" id="endDate" name="end_date" class="form-control" placeholder="End Date" style="display: none;" required>
                        <!-- @endif -->
                        <button type="submit" class="btn btn-primary">{{ __('messages.filter') }}</button>
                    </div>
                </form><br>

                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('messages.month_year') }}</th>
                            <th>{{ __('messages.tt_report') }}</th>
                            <th>{{ __('messages.ticket_no') }}</th>
                            <th>{{ __('messages.site') }}</th>
                            <th>{{ __('messages.equipment') }}</th>
                            <th>{{ __('messages.category') }}</th>
                            <th>{{ __('messages.fault_summary') }}</th>
                            <th>{{ __('messages.severity') }}</th>
                            <th>{{ __('messages.sla') }}</th>
                            <th>{{ __('messages.time_expected_closed') }}</th>
                            <th>{{ __('messages.status') }}</th>
                            <th>{{ __('messages.response_taken') }}</th>
                            <th>{{ __('messages.response_type') }}</th>
                            <th>{{ __('messages.response_DTG') }}</th>
                            <th>{{ __('messages.response_duration') }}</th>
                            <th>{{ __('messages.last_updates') }}</th>
                            <th>{{ __('messages.action') }}</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @php
                            $counter = 0; // initialize counter
                        @endphp
                        @foreach ($tickets as $tt)
                            @php
                                $counter++; // increment counter for each iteration of outer loop
                            @endphp
                            @if ($tt->ticketlog->isNotEmpty())
                                @foreach ($tt->ticketlog as $log)                                 
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tt->report_received)->format('M-y') }}</td></td>
                                        <td>{{ \Carbon\Carbon::parse($tt->report_received)->format('d/m/Y h:i A') }}</td>
                                        <td>{{ $tt->ticket_no }}</td>
                                        <td>{{ $tt->issue->site->site_name ?? " " }}</td>
                                        <td>{{ $tt->issue->equipment->asset_hostname ?? " " }} - {{ $tt->issue->equipment->asset_type ?? " " }}</td>
                                        <td>{{ $tt->issue->reqcategory->req_category ?? " " }}</td>
                                        <td>{{ $tt->issue->fault_description ?? " " }}</td>
                                        <td>
                                            @if(isset($tt->severity->severity_label))
                                                @php
                                                    $severityLabel = $tt->severity->severity_label;
                                                    $badgeClass = '';
                                                    $slaDuration = '';     // dynamically to SLA(3 months/14 days/72 hours)

                                                    switch($tt->severity->id) {
                                                        case 1:
                                                            $badgeClass = 'bg-danger';
                                                            $slaDuration = '72 Hours';      // how it would be display in column SLA
                                                            break;
                                                        case 2:
                                                            $badgeClass = 'bg-primary';
                                                            $slaDuration = '14 Days';
                                                            break;
                                                        case 3:
                                                            $badgeClass = 'bg-success';
                                                            $slaDuration = '3 Months';
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
                                        </td>
                                        <td>
                                            @if(isset($slaDuration))
                                                <span class="badge {{ $badgeClass }} me-1">{{ $slaDuration }}</span>
                                            @else
                                                N/A
                                            @endif
                                        </td>                                      
                                        
                                        <td>{{ $tt->expected_closure_time ? $tt->expected_closure_time->format('d/m/Y h:i A') : 'N/A' }}</td>
                                        <td>
                                            @if(isset($tt->ticstatus->ticstatus_label))
                                                @php
                                                    $ticstatusLabel = $tt->ticstatus->ticstatus_label;
                                                    $badgeClass = '';

                                                    switch($tt->ticstatus->id) {
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

                                                <span class="badge {{ $badgeClass }} me-1">{{ $ticstatusLabel }}</span>
                                            @else
                                                <span class="badge bg-secondary me-1"></span>
                                            @endif
                                        </td>
                                        <td>{{ $log->description ?? " " }}</td>
                                        <td>{{ $log->reaction->response_type ?? " " }}</td>
                                        <td>
                                            @if($log && $log->response_date)
                                                {{ \Carbon\Carbon::parse($log->response_date)->format('d/m/Y') }}
                                            @else
                                                {{ " " }}
                                            @endif
                                            @if($log && $log->response_time)
                                                {{ \Carbon\Carbon::parse($log->response_time)->format('h:i A') }}
                                            @else
                                                {{ " " }}
                                            @endif
                                        </td>
                                        <td>{{ $tt->getCalcDurationForLog($log) }}</td>
                                        <!-- <td>{{ $tt->update_date }}</td> -->
                                        <td>
                                            @if($log->date)
                                                {{ \Carbon\Carbon::parse($log->date)->format('d/m/Y h:i A') }}                                            
                                            @else
                                                {{ " " }}
                                            @endif
                                        </td>  
                                        <td>
                                            <form action="" method="POST">
                                                @php
                                                    $routeName = ($tt->type->id == 1) ? 'tickets.listticketlog' : 'tickets.listconsumablelog';
                                                @endphp

                                                <a class="menu-icon tf-icons bx bx-archive" href="{{ route($routeName, $tt->id) }}" style="color:#57cc99"
                                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                    title="<span>{{ __('messages.details_ticket_log') }}</span>"></a>
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>                                    
                                @endforeach
                            @else
                                <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ \Carbon\Carbon::parse($tt->report_received)->format('M-y') }}</td></td>
                                    <td>{{ \Carbon\Carbon::parse($tt->report_received)->format('d/m/Y h:i A') }}</td>
                                    <td>{{ $tt->ticket_no }}</td>
                                    <td>{{ $tt->issue->site->site_name ?? " " }}</td>
                                    <td>{{ $tt->issue->equipment->asset_hostname ?? " " }} - {{ $tt->issue->equipment->asset_type ?? " " }}</td>
                                    <td>{{ $tt->issue->reqcategory->req_category ?? " " }}</td>
                                    <td>{{ $tt->issue->fault_description ?? " " }}</td>
                                    <td>
                                        @if(isset($tt->severity->severity_label))
                                            @php
                                                $severityLabel = $tt->severity->severity_label;
                                                $badgeClass = '';
                                                $slaDuration = '';     // dynamically to SLA(3 months/14 days/72 hours)

                                                switch($tt->severity->id) {
                                                    case 1:
                                                        $badgeClass = 'bg-danger';
                                                        $slaDuration = '72 Hours';      // how it would be display in column SLA
                                                        break;
                                                    case 2:
                                                        $badgeClass = 'bg-primary';
                                                        $slaDuration = '14 Days';
                                                        break;
                                                    case 3:
                                                        $badgeClass = 'bg-success';
                                                        $slaDuration = '3 Months';
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
                                    </td>
                                    <td>
                                        @if(isset($slaDuration))
                                            <span class="badge {{ $badgeClass }} me-1">{{ $slaDuration }}</span>
                                        @else
                                            N/A
                                        @endif
                                    </td>                                      
                                    
                                    <td>{{ $tt->expected_closure_time ? $tt->expected_closure_time->format('d/m/Y h:i A') : 'N/A' }}</td>
                                    <td>
                                        @if(isset($tt->ticstatus->ticstatus_label))
                                            @php
                                                $ticstatusLabel = $tt->ticstatus->ticstatus_label;
                                                $badgeClass = '';

                                                switch($tt->ticstatus->id) {
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

                                            <span class="badge {{ $badgeClass }} me-1">{{ $ticstatusLabel }}</span>
                                        @else
                                            <span class="badge bg-secondary me-1"></span>
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>  
                                    <td>
                                        <form action="" method="POST">
                                            @php
                                                $routeName = ($tt->type->id == 1) ? 'tickets.allticketedit' : 'tickets.allconsumableedit';
                                            @endphp

                                            <a class="menu-icon tf-icons bx bx-archive" href="{{ route($routeName, $tt->id) }}" style="color:#57cc99"
                                                data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                title="<span>{{ __('messages.details_ticket_log') }}</span>"></a>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr> 
                            @endif
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

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script> -->

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
                    {extend: 'excel', 
                        title: 'Ticket Reporting', 
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ]}
                    },
                    {extend: 'pdf', 
                        title: 'Ticket Reporting', 
                        orientation: 'landscape',
                        // pageSize: 'LEGAL', 
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ]}
                    },
                    {extend: 'print', 
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ]
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

        // custom date filter reset
        document.addEventListener('DOMContentLoaded', function() {
            const dateFilter = document.getElementById('dateFilter');
            const startDate = document.getElementById('startDate');
            const endDate = document.getElementById('endDate');

            function toggleDateInputs() {
                if (dateFilter.value === 'custom_date') {
                    startDate.style.display = 'block';
                    endDate.style.display = 'block';
                    startDate.disabled = false;
                    endDate.disabled = false;
                } else {
                    startDate.style.display = 'none';
                    endDate.style.display = 'none';
                    startDate.disabled = true;
                    endDate.disabled = true;
                    startDate.value = ''; // Reset value
                    endDate.value = '';   // Reset value
                }
            }

            // Initial call to set the correct state on page load
            toggleDateInputs();

            // Add event listener to update state on change
            dateFilter.addEventListener('change', toggleDateInputs);
        });
    </script>

    <!-- <script type="text/javascript">
        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMd/m/YYYY') + ' - ' + end.format('MMMd/m/YYYY'));

                // Update the hidden input fields with the selected start and end dates
                $('#start_date').val(start.format('YYYY-MM-DD'));
                $('#end_date').val(end.format('YYYY-MM-DD'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });
    </script> -->

    <!-- <script>
        $(function() {
            $("#start_date").datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $("#end_date").datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });

        // fetch records
        function fetch(start_date, end_date) {
            $.ajax({
                url: "{{ route('tickets.report.producereport') }}",
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
        // filter
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
        // reset
        $(document).on("click", "#reset", function(e) {
            e.preventDefault();
            $("#start_date").val(''); // empty value
            $("#end_date").val('');
            $('#records').DataTable().destroy();
            fetch();
        });
    </script> -->

@stop