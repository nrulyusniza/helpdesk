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
            <form action="{{ route('issues.store') }}" method="POST">
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
                        <label class="form-label" for="site_id">Site [x]</label>
                        <select id="defaultSelect" class="form-select" name="site_id">
                            <option selected disabled>-- Select Site --</option>
                                @foreach(App\Site::all()->sortBy('site_name') as $site)
                                <option value="{{$site->id}}">{{$site->site_name}}</option>
                                @endforeach
                        </select>                        
                    </div>                
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="reportingperson_id">Reported By [x]</label>
                        <select id="defaultSelect" class="form-select" name="reportingperson_id">
                            <option selected disabled>-- Select Name --</option>
                                @foreach(App\Reportingperson::all()->sortBy('rptpers_name') as $reportingperson)
                                <option value="{{$reportingperson->id}}">{{$reportingperson->rptpers_name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="rptpers_mobile">Phone Number (Reported By)</label>
                        <input type="text" class="form-control" name="rptpers_mobile">                       
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
                        <label class="form-label" for="asset_hostname">Equipment [x]</label>
                        <select id="defaultSelect" class="form-select">
                            <option selected disabled>-- Select Equipment --</option>
                                @foreach(App\Equipment::all()->sortBy('asset_hostname') as $equipment)
                                <option value="{{$equipment->id}}">{{$equipment->asset_hostname}} - {{$equipment->asset_type}}</option>
                                @endforeach
                        </select>                     
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="created_date">Date</label>
                        <input type="date" class="form-control" name="created_date">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="attachment">Attachment</label>
                        <input class="form-control" type="file" name="attachment" id="formFile" />                   
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fault_description">Fault Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" type="text" name="fault_description"></textarea>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-control-label" for="site">Country</label>
                        <select  id="site-dropdown" class="form-control">
                            <option value="">-- Select Country --</option>
                            @foreach ($sites as $data)
                                <option value="{{$data->id}}">
                                    {{$data->site_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-control-label" for="equipment">State</label>
                        <select id="equipment-dropdown" class="form-control">
                        </select>
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

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        /*------------------------------------------
        --------------------------------------------
        Country Dropdown Change Event
        --------------------------------------------
        --------------------------------------------*/
        $('#country-dropdown').on('change', function () {
            var idCountry = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-states')}}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state-dropdown').html('<option value="">-- Select State --</option>');
                    $.each(result.states, function (key, value) {
                        $("#state-dropdown").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                    });
                    $('#city-dropdown').html('<option value="">-- Select City --</option>');
                }
            });
        });
    });
</script>