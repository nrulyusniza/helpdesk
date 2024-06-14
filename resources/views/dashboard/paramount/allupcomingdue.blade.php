@extends('layouts.template')
@section('title', 'All Upcoming Due Ticket')
@section('content')

<div class="col-xl-12">
    <div class="nav-align-top mb-4">

        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
            <li class="nav-item">
                <a href="{{ route('dashboard.mydashboard') }}" class="nav-link {{ request()->routeIs('dashboardmydashboard') ? 'active' : '' }}">
                    <i class="tf-icons bx bx-arrow-back me-1"></i> {{ __('messages.back') }}
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1"></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.paramount.allnewtoday') }}" class="nav-link {{ request()->routeIs('dashboard.paramount.allnewtoday') ? 'active' : '' }}">
                    <i class="tf-icons bx bx-folder-plus me-1"></i> {{ __('messages.new_tix_today') }}: {{ \Carbon\Carbon::now('Asia/Kuala_Lumpur')->format('d/m/Y') }}
                    <!-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1">$allNewTodayCount</span> -->
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.paramount.allupcomingdue') }}" class="nav-link {{ request()->routeIs('dashboard.paramount.allupcomingdue') ? 'active' : '' }}">
                    <i class="tf-icons bx bx-error me-1"></i> {{ __('messages.upcoming_deadlines') }}
                    <!-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1">$allUpcomingDueCount</span> -->
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.paramount.alloverdue') }}" class="nav-link {{ request()->routeIs('dashboard.paramount.alloverdue') ? 'active' : '' }}">
                    <i class="tf-icons bx bx-time-five me-1"></i> {{ __('messages.missed_deadlines') }}
                    <!-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1">$allOverdueCount</span> -->
                </a>
            </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">

                <div class="card-body">
                    <div class="table-responsive">
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
                                    <!-- <th>{{ __('messages.fault_summary') }}</th> -->
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
                                @foreach ($allUpcomingDueData as $audd)   
                                    @php
                                        $counter++; // increment counter for each iteration of outer loop
                                    @endphp
                                    @if ($audd->ticketlog->isNotEmpty())
                                        @foreach ($audd->ticketlog as $log)                                 
                                            <tr>
                                                <td>{{ $counter }}</td>
                                                <td>{{ \Carbon\Carbon::parse($audd->report_received)->format('M-y') }}</td></td>
                                                <td>{{ \Carbon\Carbon::parse($audd->report_received)->format('d/m/Y h:i A') }}</td>
                                                <td>{{ $audd->ticket_no }}</td>
                                                <td>{{ $audd->issue->site->site_name ?? " " }}</td>
                                                <td>{{ $audd->issue->equipment->asset_hostname ?? " " }} - {{ $audd->issue->equipment->asset_type ?? " " }}</td>
                                                <td>{{ $audd->issue->reqcategory->req_category ?? " " }}</td>
                                                <!-- <td>{{ $audd->issue->fault_description ?? " " }}</td> -->
                                                <td>
                                                    @if(isset($audd->severity->severity_label))
                                                        @php
                                                            $severityLabel = $audd->severity->severity_label;
                                                            $badgeClass = '';
                                                            $slaDuration = '';     // dynamically to SLA(3 months/14 days/72 hours)

                                                            switch($audd->severity->id) {
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
                                                
                                                <td>{{ $audd->expected_closure_time ? $audd->expected_closure_time->format('d/m/Y h:i A') : 'N/A' }}</td>
                                                <td>
                                                    @if(isset($audd->ticstatus->ticstatus_label))
                                                        @php
                                                            $ticstatusLabel = $audd->ticstatus->ticstatus_label;
                                                            $badgeClass = '';

                                                            switch($audd->ticstatus->id) {
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
                                                <td>{{ $audd->getCalcDurationForLog($log) }}</td>
                                                <!-- <td>{{ $audd->update_date }}</td> -->
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
                                                            $routeName = ($audd->type->id == 1) ? 'tickets.allticketedit' : 'tickets.allconsumableedit';
                                                        @endphp

                                                        <a class="menu-icon tf-icons bx bx-archive" href="{{ route($routeName, $audd->id) }}" style="color:#57cc99"
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
                                            <td>{{ \Carbon\Carbon::parse($audd->report_received)->format('M-y') }}</td></td>
                                            <td>{{ \Carbon\Carbon::parse($audd->report_received)->format('d/m/Y h:i A') }}</td>
                                            <td>{{ $audd->ticket_no }}</td>
                                            <td>{{ $audd->issue->site->site_name ?? " " }}</td>
                                            <td>{{ $audd->issue->equipment->asset_hostname ?? " " }} - {{ $audd->issue->equipment->asset_type ?? " " }}</td>
                                            <td>{{ $audd->issue->reqcategory->req_category ?? " " }}</td>
                                            <!-- <td>{{ $audd->issue->fault_description ?? " " }}</td> -->
                                            <td>
                                                @if(isset($audd->severity->severity_label))
                                                    @php
                                                        $severityLabel = $audd->severity->severity_label;
                                                        $badgeClass = '';
                                                        $slaDuration = '';     // dynamically to SLA(3 months/14 days/72 hours)

                                                        switch($audd->severity->id) {
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
                                            
                                            <td>{{ $audd->expected_closure_time ? $audd->expected_closure_time->format('d/m/Y h:i A') : 'N/A' }}</td>
                                            <td>
                                                @if(isset($audd->ticstatus->ticstatus_label))
                                                    @php
                                                        $ticstatusLabel = $audd->ticstatus->ticstatus_label;
                                                        $badgeClass = '';

                                                        switch($audd->ticstatus->id) {
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
                                                        $routeName = ($audd->type->id == 1) ? 'tickets.allticketedit' : 'tickets.allconsumableedit';
                                                    @endphp

                                                    <a class="menu-icon tf-icons bx bx-archive" href="{{ route($routeName, $audd->id) }}" style="color:#57cc99"
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
                {extend: 'excel', title: 'All Upcoming Deadlines Ticket', exportOptions: {
                    // columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ]
                    columns: ':not(:last-child)'        // exclude the last column (action)
                    }
                },
                {extend: 'pdf', title: 'All Upcoming Deadlines Ticket', exportOptions: {
                    // columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ]
                    columns: ':not(:last-child)'        // exclude the last column (action)
                    }
                },
                {extend: 'print', exportOptions: {
                    // columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ]
                    // columns: ':not(:eq(17))'         // exclude the 18th column (index 17)
                    columns: ':not(:last-child)'        // exclude the last column (action)
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

@stop