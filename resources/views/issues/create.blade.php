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
                        <label class="form-label" for="request_type">Request Type</label>
                        <select id="defaultSelect" class="form-select" name="request_type">
                            <option selected disabled>-- Select Request Type--</option>
                                @foreach(App\Type::all() as $type)
                                <option value="{{$type->id}}">{{$type->request_type}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="site_name">Site [x]</label>
                        <select id="defaultSelect" class="form-select" name="site_name">
                            <option selected disabled>-- Select Site --</option>
                                @foreach(App\Site::all()->sortBy('site_name') as $site)
                                <option value="{{$site->id}}">{{$site->site_name}}</option>
                                @endforeach
                        </select>                        
                    </div>                
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="rptpers_name">Reported By [x]</label>
                        <select id="defaultSelect" class="form-select" name="rptpers_name">
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
                        <label class="form-label" for="req_category">Category</label>
                        <select id="defaultSelect" class="form-select" name="req_category">
                            <option selected disabled>-- Select Category--</option>
                                @foreach(App\Reqcategory::all() as $reqcategory)
                                <option value="{{$reqcategory->id}}">{{$reqcategory->req_category}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="asset_hostname">Equipment [x]</label>
                        <select id="defaultSelect" class="form-select">
                            <option selected disabled>-- Select Equipment--</option>
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