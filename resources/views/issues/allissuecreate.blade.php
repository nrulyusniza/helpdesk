@extends('layouts.template')
@section('title', 'New Request')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-12">
    <div class="card">

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">New Request</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('issues.allissuestore') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="type_id">Request Type</label>
                        <select id="defaultSelect" class="form-select" name="type_id">
                            <option selected disabled>-- Select Request Type--</option>
                                @foreach(App\Type::all() as $type)
                                <option value="{{$type->id}}">{{$type->request_type}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="site_id">Site</label>
                        <select id="site_id" class="form-select" name="site_id">
                            <option selected disabled>-- Select Site --</option>
                                @foreach(App\Site::all()->sortBy('site_name') as $site)
                                <option value="{{$site->id}}">{{$site->site_name}}</option>
                                @endforeach
                        </select>                        
                    </div>                
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="reportingperson_id">Reported By [x]</label>
                        <select id="reportingperson_id" class="form-select" name="reportingperson_id">
                            <!-- <option selected disabled>-- Select Name --</option>
                                @foreach(App\Reportingperson::all()->sortBy('rptpers_name') as $reportingperson)
                                <option value="{{$reportingperson->id}}">{{$reportingperson->rptpers_name}}</option>
                                @endforeach -->
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone_no">Phone Number (Reported By)</label>
                        <input type="number" class="form-control" name="phone_no">                       
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="reqcategory_id">Category</label>
                        <select id="defaultSelect" class="form-select" name="reqcategory_id">
                            <option selected disabled>-- Select Category --</option>
                                @foreach(App\Reqcategory::all() as $reqcategory)
                                <option value="{{$reqcategory->id}}">{{$reqcategory->req_category}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="equipment_id">Equipment</label>
                        <select id="equipment_id" class="form-select" name="equipment_id">
                            <!-- <option selected disabled>-- Select Equipment --</option>
                                @foreach(App\Equipment::all()->sortBy('asset_hostname') as $equipment)
                                <option value="{{$equipment->id}}">{{$equipment->asset_hostname}} - {{$equipment->asset_type}}</option>
                                @endforeach -->
                        </select>                     
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="create_date">Date</label>
                        <input type="date" class="form-control" name="create_date">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="attachment">Attachment</label>
                        <input class="form-control" type="file" name="attachment" id="formFile" />                   
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fault_description">Fault Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" type="text" name="fault_description"></textarea>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('issues.allissue') }}">Cancel</a>
                </div>                
            </form>
        </div>

    </div>
</div>

@stop

@section('scriptlibraries')

    <!-- Dropdown dynamically -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#site_id').change(function() {
                var siteId = $(this).val();

                // reportingperson_id
                $.ajax({
                    url: '/get-reportingperson/' + siteId,
                    type: 'GET',
                    success: function(data) {
                        // sort reportingperson selection by rptpers_name
                        data.sort(function(a, b) {
                            return a.rptpers_name.localeCompare(b.rptpers_name);
                        });

                        $('#reportingperson_id').empty();
                        $('#reportingperson_id').append('<option selected disabled>-- Select Name --</option>');
                        
                        $.each(data, function(index, reportingperson) {
                            $('#reportingperson_id').append('<option value="' + reportingperson.id + '">' + reportingperson.rptpers_name + '</option>');
                        });
                    }
                });

                // equipment_id
                $.ajax({
                    url: '/get-equipment/' + siteId,
                    type: 'GET',
                    success: function(data) {
                        // sort equipment selection by asset_hostname
                        data.sort(function(a, b) {
                            return a.asset_hostname.localeCompare(b.asset_hostname);
                        });

                        $('#equipment_id').empty();
                        $('#equipment_id').append('<option selected disabled>-- Select Equipment --</option>');
                        
                        $.each(data, function(index, equipment) {
                            $('#equipment_id').append('<option value="' + equipment.id + '">' + equipment.asset_hostname + ' - ' + equipment.asset_type + '</option>');
                        });
                    }
                });

            });
        });
    </script>

@stop
