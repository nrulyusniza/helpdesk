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
            <form action="{{ route('issues.entireissuestore') }}" method="POST">
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
                        <select id="defaultSelect" class="form-select" name="site_id">
                            @foreach(App\Site::all()->sortBy('site_name') as $site)
                                @if(auth()->user()->site_id == $site->id)                                    
                                    <option value="{{ $site->id }}" selected>{{ $site->site_name }}</option>
                                @endif
                            @endforeach
                        </select>                        
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="reportingperson_id">Reported By</label>
                        <select id="defaultSelect" class="form-select" name="reportingperson_id">
                            <option selected disabled>-- Select Name --</option>
                                @foreach(App\Reportingperson::where('site_id', auth()->user()->site_id)->orderBy('rptpers_name')->get() as $reportingperson)
                                <option value="{{$reportingperson->id}}">{{$reportingperson->rptpers_name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone_no">Phone Number (Reported By)</label>
                        <input type="number" class="form-control" name="phone_no">                       
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="reqcategory_id">Category</label>
                        <select id="defaultSelect" class="form-select" name="reqcategory_id">
                            <option selected disabled>-- Select Category--</option>
                                @foreach(App\Reqcategory::all() as $reqcategory)
                                <option value="{{$reqcategory->id}}">{{$reqcategory->req_category}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Equipment</label>
                        <select id="defaultSelect" class="form-select" name="equipment_id">
                            <option selected disabled>-- Select Equipment --</option>
                            @foreach(App\Equipment::where('site_id', auth()->user()->site_id)->orderBy('asset_hostname')->get() as $equipment)
                                <option value="{{ $equipment->id }}">{{ $equipment->asset_hostname }} - {{ $equipment->asset_type }}</option>
                            @endforeach
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
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('issues.entireissue') }}">Cancel</a>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection