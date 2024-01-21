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
            <h4 class="m-0 font-weight-bold text-primary">{{ __('messages.new_request') }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('issues.allissuestore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="request_type">{{ __('messages.request_type') }}</label>
                        <select id="defaultSelect" class="form-select" name="request_type">
                            <option selected disabled>-- {{ __('messages.select_request_type') }} --</option>
                                @foreach(App\Type::all() as $type)
                                <option value="{{$type->id}}">{{$type->request_type}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="site_id">{{ __('messages.site') }}</label>
                        <select id="site_id" class="form-select" name="site_id">
                            <option selected disabled>-- {{ __('messages.select_site') }} --</option>
                                @foreach(App\Site::all()->sortBy('site_name') as $site)
                                <option value="{{$site->id}}">{{$site->site_name}}</option>
                                @endforeach
                        </select>                        
                    </div>                
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="reportingperson_id">{{ __('messages.reported_by') }}</label>
                        <select id="reportingperson_id" class="form-control" name="reportingperson_id">
                            <!-- <option selected disabled>-- Select Name --</option>
                                @foreach(App\Reportingperson::all()->sortBy('rptpers_name') as $reportingperson)
                                <option value="{{$reportingperson->id}}">{{$reportingperson->rptpers_name}}</option>
                                @endforeach -->
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone_no">{{ __('messages.phone_number') }}</label>
                        <input type="number" class="form-control" name="phone_no">                       
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="reqcategory_id">{{ __('messages.category') }}</label>
                        <select id="defaultSelect" class="form-select" name="reqcategory_id">
                            <option selected disabled>-- {{ __('messages.select_category') }} --</option>
                                @foreach(App\Reqcategory::all() as $reqcategory)
                                <option value="{{$reqcategory->id}}">{{$reqcategory->req_category}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="equipment_id">{{ __('messages.equipment') }}</label>
                        <select id="equipment_id" class="form-select" name="equipment_id">
                            <!-- <option selected disabled>-- Select Equipment --</option>
                                @foreach(App\Equipment::all()->sortBy('asset_hostname') as $equipment)
                                <option value="{{$equipment->id}}">{{$equipment->asset_hostname}} - {{$equipment->asset_type}}</option>
                                @endforeach -->
                        </select>                     
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="create_date">{{ __('messages.date') }}</label>
                        <input type="date" class="form-control" name="create_date">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="attachment">{{ __('messages.attachment') }}</label>
                        <input class="form-control" type="file" name="attachment" id="formFile" />                   
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fault_description">{{ __('messages.fault_desc') }}</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" type="text" name="fault_description"></textarea>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">{{ __('messages.submit') }}</button>
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('issues.allissue') }}">{{ __('messages.cancel') }}</a>
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
                        $('#reportingperson_id').append('<option selected disabled>-- {{ __('messages.select_name') }} --</option>');
                        
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
                        $('#equipment_id').append('<option selected disabled>-- {{ __('messages.select_equipment') }} --</option>');
                        
                        $.each(data, function(index, equipment) {
                            $('#equipment_id').append('<option value="' + equipment.id + '">' + equipment.asset_hostname + ' - ' + equipment.asset_type + '</option>');
                        });
                    }
                });

            });
        });
    </script>

@stop
