@extends('layouts.template')

@section('content')

<div class="col-12">
  <div class="card">
    <div class="d-flex align-items-end row">
      <div class="col-sm-7">
        <div class="card-body">
          <h5 class="card-title text-primary">Welcome back, {{ Auth::user()->fullname }}! 🎉</h5>
          <p class="mb-4">
          You are logged in!
          </p>                       
        </div>
      </div>
      <div class="col-sm-5 text-center text-sm-left">
        <div class="card-body pb-0 px-0 px-md-4">
          <img
            src="{{ asset('pages/assets/img/illustrations/man-with-laptop-light.png') }}"
            height="140"
            alt="View Badge User"
            data-app-dark-img="{{ asset('pages/illustrations/man-with-laptop-dark.png') }}"
            data-app-light-img="{{ asset('pages/illustrations/man-with-laptop-light.png') }}" />
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
