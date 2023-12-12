@extends('layouts.template')
@section('title', 'Asset Log')
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
            <h4 class="m-0 font-weight-bold text-primary">Asset Details : {{ $equipment->asset_hostname }}</h4>
        </div>

        <div class="card-body">            
            <div class="row">
                <!-- readonly asset information -->
                <div class="col-xl">
                    <div class="card mb-4" style="background-color: #f4f3ee;">
                        <div class="card-body">                            
                            <div class="mb-3">
                                <label class="form-label" for="asset_hostname">Hostname</label>
                                <input type="text" class="form-control" name="asset_hostname" value="{{ $equipment->asset_hostname }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="asset_location">Origin Location</label>
                                <input type="text" class="form-control" name="asset_location" value="{{ $equipment->asset_location }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="asset_ip">IP</label>
                                <input type="text" class="form-control" name="asset_ip" value="{{ $equipment->asset_ip }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="asset_type">Asset Type</label>
                                <input type="text" class="form-control" name="asset_type" value="{{ $equipment->asset_type }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="site_id">Site</label>
                                <select id="defaultSelect" class="form-select" name="site_id">                        
                                    @foreach(App\Site::all()->sortBy('site_name') as $site)
                                        @if(auth()->user()->site_id == $site->id)                                    
                                            <option value="{{ $site->id }}" selected>{{ $site->site_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="asset_kewpa">Kewpa</label>
                                <input type="text" class="form-control" name="asset_kewpa" value="{{ $equipment->asset_kewpa }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="asset_seriesno">Series No</label>
                                <input type="text" class="form-control" name="asset_seriesno" value="{{ $equipment->asset_seriesno }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('equipments.allassetedit',$equipment->id) }}">Back to Edit Form</a>
                </div> 
                </div>

                <!-- equipment log new record -->
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('equipments.allassetupdate',$equipment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="asset_newlocation">Location</label>
                                    <input type="text" class="form-control" name="asset_newlocation">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="log_updatedat">Updated Date</label>
                                    <input type="date" class="form-control" name="log_updatedat">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="equipmentstatus_id">Status</label>
                                    <select id="defaultSelect" class="form-select" name="equipmentstatus_id">
                                        <option selected disabled>-- Select Status --</option>
                                            @foreach(App\Equipmentstatus::all()->sortBy('assetstatus_label') as $equipmentstatus)
                                            <option value="{{$equipmentstatus->id}}">{{$equipmentstatus->assetstatus_label}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <a type="cancel" class="btn btn-outline-secondary" href="{{ route('equipments.allasset') }}">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- text divider -->
            <div class="divider">
                <div class="divider-text">
                    <i class="bx bx-cross"></i>
                </div>
            </div>

            <h4 class="mb-0 text-primary">Asset Log</h4><br>

            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Location</th>
                                    <th>Updated Date [x]</th>
                                    <th>Status [x]</th>
                                </tr>
                            </thead>
                            @foreach($equipment->equipmentlog as $eqlog)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $eqlog->id }}</td>
                                    <td>{{ $eqlog->asset_newlocation }}</td>
                                    <td>{{ $eqlog->log_updatedat }}</td>
                                    <td>{{ $eqlog->equipmentstatus_id }}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</div>

@endsection