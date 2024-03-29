@extends('layouts.template')
@section('title', 'Asset List')
@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="col-12">
    <div class="card">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.asset_list') }}</h4>
            <div class="btn-text-right">
                <a href="{{ route('equipments.allassetcreate') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; {{ __('messages.new_asset') }}</button>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('messages.hostname') }}</th>
                            <th>{{ __('messages.origin_location') }}</th>
                            <th>{{ __('messages.asset_type') }}</th>
                            <th>{{ __('messages.site') }}</th>
                            <th>{{ __('messages.latest_status') }}</th>
                            <th>{{ __('messages.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($equipments as $e)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $e->asset_hostname }}</td>
                            <td>{{ $e->asset_location }}</td>
                            <td>{{ $e->asset_type }}</td>
                            <td>{{ $e->site->site_name ?? "-" }}</td>
                            <!-- <td>{{ $e->equipmentlog->last()->equipmentstatus->assetstatus_label ?? "-" }}</td> -->
                            <td>
                                @if(null !== ($assetstatusLabel = $e->equipmentlog->last()->equipmentstatus->assetstatus_label ?? null))
                                    @php
                                        $badgeClass = '';

                                        switch($e->equipmentlog->last()->equipmentstatus->id ?? null) {
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

                                    <span class="badge {{ $badgeClass }} me-1">{{ $assetstatusLabel }}</span>
                                @else
                                    <span class="badge bg-secondary me-1"></span>
                                @endif
                            </td>   <!-- badges that depends on database -->  
                            <td>
                                <form action="{{ route('equipments.destroy',$e->id) }}" method="POST">
                                    <!-- <a class="menu-icon tf-icons bx bx-edit" href="{{ route('equipments.allassetedit',$e->id) }}"></a>
                                    <a class="menu-icon tf-icons bx bx-archive" href="{{ route('equipments.allassetlog',$e->id) }}" style="color:#57cc99"></a> -->
                                    <a class="menu-icon tf-icons bx bx-edit" href="{{ route('equipments.allassetedit',$e->id) }}"
                                        data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                        title="<span>{{ __('messages.edit') }}</span>"></a>
                                    <a class="menu-icon tf-icons bx bx-archive" href="{{ route('equipments.allassetlog',$e->id) }}" style="color:#57cc99"
                                        data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                        title="<span>{{ __('messages.asset_log') }}</span>"></a>
                                    @csrf
                                    @method('DELETE')                    
                                    <!-- <a type="submit" class="menu-icon tf-icons bx bx-trash" style="color:#ff0000" onclick="confirmation(event)"></a> -->
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
                {extend: 'excel', title: 'Asset List', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]}
                },
                {extend: 'pdf', title: 'Asset List', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]}
                },
                {extend: 'print', exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
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