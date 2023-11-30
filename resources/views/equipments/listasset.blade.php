@extends('layouts.template')
@section('title', 'Asset List')
@section('content')

<div class="col-12">
    <div class="card">
        
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Asset List</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hostname</th>
                            <th>Origin Location</th>
                            <th>Asset Type</th>
                            <th>Kewpa</th>
                            <th>Series No</th>
                        </tr>
                    </thead>                    
                    <tbody class="table-border-bottom-0">
                        @foreach ($equipments as $e)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $e->asset_hostname }}</td>
                            <td>{{ $e->asset_location }}</td>
                            <td>{{ $e->asset_type }}</td>
                            <td>{{ $e->asset_kewpa }}</td>
                            <td>{{ $e->asset_seriesno }}</td>
                        </tr>
                        @endforeach
                    </tbody>                    
                </table>
            </div>           
        </div>

    </div>
</div>
<!--/ Bordered Table -->

@endsection