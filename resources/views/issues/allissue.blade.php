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
            <h4 class="m-0 font-weight-bold text-primary">Request List</h4>
            <div class="btn-text-right">
                <a href="{{ route('issues.create') }}"
                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>&nbsp; New Request</button>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Request No</th>
                            <th>Reported By</th>
                            <th>Report Date</th>
                            <th>Site</th>
                            <th>Asset</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>User [DB Fullname]</th>
                            <th>Action</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($issues as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $i->request_no }}</td>
                            <td>{{ $i->reported_by }}</td>
                            <td>{{ $i->create_date->format('M d, Y') }}</td> <!-- 0000-00-00, in result  -0001 -->
                            <td>{{ $i->site->site_name ?? " " }}</td>
                            <td>{{ $i->equipment->asset_hostname ?? " " }} - {{ $i->equipment->asset_type ?? " " }}</td>
                            <td>{{ $i->reqcategory->req_category ?? " " }}</td>
                            <td>{{ $i->status->status_label ?? " " }}</td> <!-- badges -->
                            <td>{{ $i->created_by ?? " " }}</td>
                            <td>
                                <form action="{{ route('issues.destroy',$i->id) }}" method="POST">
                                    <a class="menu-icon tf-icons bx bx-expand-alt" style='color:#716d6d'
                                        type="button"
                                        data-bs-offset="0,4"
                                        data-bs-placement="top"
                                        data-bs-html="true"
                                        data-bs-toggle="modal"
                                        data-bs-target="#largeModal"
                                        title="View More">
                                    </a>

                                    <!-- modal -->
                                    <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-primary" id="exampleModalLabel3">Request No: {{ $i->request_no }}</h5>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="request_type">Request Type [x]</label>
                                                            <select id="defaultSelect" class="form-select" name="request_type">
                                                                <option selected disabled>-- Select Request Type --</option>
                                                                    @foreach(App\Type::all() as $type)
                                                                    <option value="{{$type->id}}">{{$type->request_type}}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="site_name">Site</label>
                                                            <input type="text" class="form-control" name="site_name" value="{{ $i->site->site_name }}" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="reported_by">Reported By</label>
                                                            <input type="text" class="form-control" name="reported_by" value="{{ $i->reported_by }}" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="phone_no">Phone Number (Reported By)</label>
                                                            <input type="text" class="form-control" name="phone_no" value="{{ $i->phone_no }}" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="req_category">Category</label>
                                                            <input type="text" class="form-control" name="req_category" value="{{ $i->reqcategory->req_category }}" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="status_label">Status</label>
                                                            <input type="text" class="form-control" name="status_label" value="{{ $i->status->status_label }}" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label">Equipment [x]</label>
                                                            <select id="defaultSelect" class="form-select" name="asset_hostname">
                                                                <option selected disabled>-- Select Equipment --</option>
                                                                    @foreach(App\Equipment::all() as $equipment)
                                                                    <option value="{{ $equipment->asset_hostname .'-'. $equipment->asset_type }}">{{ $equipment->asset_hostname }} - {{ $equipment->asset_type }}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="attachment">Attachment [x]</label>
                                                            <input type="file" class="form-control" name="attachment" value="{{ $i->attachment }}" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="fault_description">Fault Description</label>
                                                            <!-- <input type="text" class="form-control" name="fault_description" value="{{ $i->fault_description }}" readonly> -->
                                                            <textarea class="form-control" name="fault_description" rows="5" readonly>{{ $i->fault_description }}</textarea>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="created_by">Created By</label>
                                                            <input type="text" class="form-control" name="created_by" value="{{ $i->created_by }}" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="create_date">Create Date</label>
                                                            <input type="text" class="form-control" name="create_date" value="{{ $i->create_date->format('M d, Y') }}" readonly>
                                                        </div>
                                                    </div>

                                                    <!-- text divider -->
                                                    <div class="divider">
                                                        <div class="divider-text">
                                                            <i class="bx bx-cross"></i>
                                                        </div>
                                                    </div>

                                                    <h5 class="mb-0 text-warning">Admin Response</h5><br>

                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="admin_comments">Admin Comments</label>
                                                            <!-- <input type="text" class="form-control" name="admin_comments" value="{{ $i->admin_comments }}" readonly> -->
                                                            <textarea class="form-control" name="admin_comments" rows="5" readonly>{{ $i->admin_comments }}</textarea>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="severity_label">Severity</label>
                                                            <input type="text" class="form-control" name="severity_label" value="{{ $i->severity->severity_label }}" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="updated_by">Updated By</label>
                                                            <input type="text" class="form-control" name="updated_by" value="{{ $i->updated_by }}" readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="update_date">Update Date</label>
                                                            <input type="text" class="form-control" name="update_date" value="{{ $i->update_date->format('M d, Y') }}" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" href="{{ route('issues.edit',$i->id) }}">Edit boleh ke(?)</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

@endsection