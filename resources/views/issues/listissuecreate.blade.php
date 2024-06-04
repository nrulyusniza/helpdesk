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
            <form action="{{ route('issues.listissuestore') }}" method="POST">
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
                        <select id="defaultSelect" class="form-select" name="site_id">
                            @foreach(App\Site::all()->sortBy('site_name') as $site)
                                @if(auth()->user()->site_id == $site->id)                                    
                                    <option value="{{ $site->id }}" selected>{{ $site->site_name }}</option>
                                @endif
                            @endforeach
                        </select>                        
                    </div>
                    <!-- <div class="mb-3 col-md-6">
                        <label class="form-label" for="reportingperson_id">{{ __('messages.reported_by') }}</label>
                        <select id="defaultSelect" class="form-select" name="reportingperson_id">
                            <option selected disabled>-- {{ __('messages.select_name') }} --</option>
                                @foreach(App\Reportingperson::where('site_id', auth()->user()->site_id)->orderBy('rptpers_name')->get() as $reportingperson)
                                    <option value="{{$reportingperson->id}}">{{$reportingperson->rptpers_name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone_no">{{ __('messages.phone_number') }}</label>
                        <input type="number" class="form-control" name="phone_no" id="phone_no">                      
                    </div> -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="reportingperson_id">{{ __('messages.reported_by') }}</label>
                        <select id="reportingpersonSelect" class="form-select" name="reportingperson_id" onchange="prefillPhoneNo()">
                            <option selected disabled>-- {{ __('messages.select_name') }} --</option>
                            @foreach(App\Reportingperson::where('site_id', auth()->user()->site_id)->orderBy('rptpers_name')->get() as $reportingperson)
                                <option value="{{$reportingperson->id}}" data-mobile="{{$reportingperson->rptpers_mobile}}">{{$reportingperson->rptpers_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone_no">{{ __('messages.phone_number') }}</label>
                        <input type="number" class="form-control" name="phone_no" id="phone_no">
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
                        <label class="form-label">{{ __('messages.equipment') }}</label>
                        <select id="defaultSelect" class="form-select" name="equipment_id">
                            <option selected disabled>-- {{ __('messages.select_equipment') }} --</option>
                                @foreach(App\Equipment::where('site_id', auth()->user()->site_id)->orderBy('asset_hostname')->get() as $equipment)
                                    <option value="{{ $equipment->id }}">{{ $equipment->asset_hostname }} - {{ $equipment->asset_type }}</option>
                                @endforeach
                        </select>                     
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="create_date">{{ __('messages.date') }}</label>
                        <input type="date" class="form-control" name="create_date" value="{{ \Carbon\Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d') }}">
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
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('issues.listissue') }}">{{ __('messages.cancel') }}</a>
                </div>
            </form>
        </div>
        
    </div>
</div>

@stop

@section('scriptlibraries')

    <script>
        // $(document).ready(function() {
        //     // when a reporting person is selected, their rptpers_mobile is automatically filled in the phone_no field
        //     $('#reportingperson_id').change(function() {
        //         var selectedOption = $(this).find('option:selected');
        //         var mobileNo = selectedOption.data('mobile');
        //         $('#phone_no').val(mobileNo);
        //     });
        // });

        // when a reporting person is selected, their rptpers_mobile is automatically filled in the phone_no field
        function prefillPhoneNo() {
            var select = document.getElementById('reportingpersonSelect');
            var phoneInput = document.getElementById('phone_no');
            var selectedOption = select.options[select.selectedIndex];
            var mobile = selectedOption.getAttribute('data-mobile');
            phoneInput.value = mobile;
        }
    </script>

@stop