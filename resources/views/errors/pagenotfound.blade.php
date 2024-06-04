@extends('layouts.thispagenotfound')
@section('title', '!!! PAGE ERROR !!!')
@section('content')

<!-- Error -->
<div class="container-xxl container-p-y">
    <div class="misc-wrapper">
        <h2 class="mb-2 mx-2">{{ __('messages.page_not_found') }} :(</h2>
        <p class="mb-4 mx-2">Oops! 😖 {{ __('messages.url_not_found') }}.</p>
        <a href="{{ route('dashboard.mydashboard') }}" class="btn btn-primary">{{ __('messages.back_to_dashboard') }}</a>
        <div class="mt-3">
            <img
            src="{{ asset('pages/assets/img/illustrations/page-misc-error-light.png') }}" 
            alt="page-misc-error-light"
            width="500"
            class="img-fluid"
            data-app-dark-img="{{ asset('pages/illustrations/page-misc-error-dark.png') }}"
            data-app-light-img="{{ asset('pages/illustrations/page-misc-error-light.png') }}" />
        </div>
    </div>
</div>
<!-- /Error -->

@endsection