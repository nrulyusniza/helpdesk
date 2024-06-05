<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('pages/assets/') }}"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') | NCO Helpdesk</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('pages/assets/img/favicon/favicon_atm.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('pages/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('pages/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('pages/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('pages/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('pages/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('pages/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('pages/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('pages/assets/js/config.js') }}"></script>

    <!-- DataTables -->
    <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Toastr -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" 
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <!-- Donut Chart -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- logout but not necessary, can delete later, use for logout modal -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.min.js"></script> -->

    <!-- Logout Confirmation Messages -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    
    <!-- Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Chatbot -->
    <!-- <link rel="stylesheet" href="{{asset('css/botchat2.css')}}"> -->

    <!-- Language -->
    <link rel="stylesheet" href="{{asset('css/translate.css')}}">

    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <!-- Timestamp for Notifications -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="" class="app-brand-link">
              <!-- <img src="{{ asset('pages/assets/img/favicon/atm_27.svg') }}"/> -->
              <span class="app-brand-text demo menu-text fw-bold ms-2">
                <span style="text-transform:capitalize;">NCO Helpdesk</span>
              </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <!-- /////////////////////////////////////////////////////// Super Admin /////////////////////////////////////////////////////// -->
          @if(Auth::user()->role_id==1)
          <ul class="menu-inner py-1">
            <!-- 1- Dashboard -->
            <li class="menu-item {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
              <a href="{{ route('dashboard.mydashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_dashboard') }}</span>
              </a>
            </li>

            <!-- 2- Issue Tracking -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">{{ __('messages.sm_tracking') }}</span>
            </li>
            <li class="menu-item {{ request()->routeIs('issues*') ? 'active' : '' }}">
              @php
                $count = \App\Issue::where('status_id', '=', 1)->count();
              @endphp
              <a href="{{ route('issues.allissue') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_request') }}</span>
                <span class="flex-shrink-0 badge badge-center bg-danger w-px-20 h-px-20">{{ $count }}</span>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('tickets.allticket*') ? 'active' : '' }}">
              @php
                $count = \App\Ticket::where('ticstatus_id', '!=', 4)
                                          ->where('ticket_type', '=', 1)
                                          ->count();
              @endphp
              <a href="{{ route('tickets.allticket') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_ticket') }}</span>
                <span class="flex-shrink-0 badge badge-center bg-danger w-px-20 h-px-20">{{ $count }}</span>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('tickets.allconsumable*') ? 'active' : '' }}">
              @php
                $count = \App\Ticket::where('ticstatus_id', '!=', 4)
                                          ->where('ticket_type', '=', 2)
                                          ->count();
              @endphp
              <a href="{{ route('tickets.allconsumable') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_consumables') }}</span>
                <span class="flex-shrink-0 badge badge-center bg-danger w-px-20 h-px-20">{{ $count }}</span>
              </a>
            </li>

            <!-- 3- Asset & Site Management -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('messages.sm_assetsitemgt') }}</span></li>
            <li class="menu-item {{ request()->routeIs('equipments.allasset*') ? 'active' : '' }}">
              <a href="{{ route('equipments.allasset') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-compass"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_asset') }}</span>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('sites*') ? 'active' : '' }}">
              <a href="{{ route('sites.allsite') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-map-pin"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_site') }}</span>
              </a>
            </li>

            <!-- 4- User Management -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('messages.sm_usermgt') }}</span></li>
            <li class="menu-item {{ request()->routeIs('roles*') ? 'active' : '' }}">
              <a href="{{ route('roles.allrole') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_usergrps') }}</span>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('users*') ? 'active' : '' }}">
              <a href="{{ route('users.alluser') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_user') }}</span>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('reportingpersons.allreportingperson*') ? 'active' : '' }}">
              <a href="{{ route('reportingpersons.allreportingperson') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_rprtpers') }}</span>
              </a>
            </li>

            <!-- 5- Knowledge Management -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('messages.sm_knowledgemgt') }}</span></li>
            <li class="menu-item {{ request()->routeIs('knowledgebases.allknowledgebase*') ? 'active' : '' }}">
              <a href="{{ route('knowledgebases.allknowledgebase') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-info-circle"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_kb') }}</span>
              </a>
            </li>

            <!-- 6- Others -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('messages.sm_others') }}</span></li>
            <li class="menu-item {{ request()->routeIs('tickets.report.producereport') ? 'active' : '' }}">
              <a href="{{ route('tickets.report.producereport') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_report') }}</span>
              </a>
            </li>
            <li class="menu-item {{ request()->is('myextension') || 
              request()->is('types*') || request()->is('reqcategorys*') || request()->is('severitys*') || request()->is('statuss*') || 
              request()->is('reactions*') || request()->is('kbcategorys*') || request()->is('ticstatuss*') || request()->is('equipmentstatuss*') ? 'active' : '' }}">
              <a href="{{ route('myextension') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-extension"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_ext') }}</span>
              </a>
            </li>
          </ul>
          @endif

          <!-- /////////////////////////////////////////////////////// Site Admin /////////////////////////////////////////////////////// -->
          @if(Auth::user()->role_id==2)
          <ul class="menu-inner py-1">
            <!-- 1- Dashboard -->
            <li class="menu-item {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
              <a href="{{ route('dashboard.dashboardadmin') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_dashboard') }}</span>
              </a>
            </li>

            <!-- 2- Issue Tracking -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">{{ __('messages.sm_tracking') }}</span>
            </li>
            <li class="menu-item {{ request()->routeIs('issues.listissue*') ? 'active' : '' }}">
              @php
                $siteId = Auth::user()->site_id;
                $count = \App\Issue::where('site_id', $siteId)
                                          ->where('status_id', '=', 1)
                                          ->count();
              @endphp
              <a href="{{ route('issues.listissue') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_request') }}</span>
                <span class="flex-shrink-0 badge badge-center bg-danger w-px-20 h-px-20">{{ $count }}</span>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('tickets.listticket*') ? 'active' : '' }}">
              @php
                $siteId = Auth::user()->site_id;
                $count = \App\Ticket::whereHas('issue', function ($query) use ($siteId) {
                                                  $query->where('site_id', $siteId);
                                              })->where('ticstatus_id', '!=', 4)
                                                ->where('ticket_type', '=', 1)
                                                ->count();
              @endphp
              <a href="{{ route('tickets.listticket') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_ticket') }}</span>
                <span class="flex-shrink-0 badge badge-center bg-danger w-px-20 h-px-20">{{ $count }}</span>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('tickets.listconsumable*') ? 'active' : '' }}">
              @php
                $siteId = Auth::user()->site_id;
                $count = \App\Ticket::whereHas('issue', function ($query) use ($siteId) {
                                                  $query->where('site_id', $siteId);
                                              })->where('ticstatus_id', '!=', 4)
                                                ->where('ticket_type', '=', 2)
                                                ->count();
              @endphp
              <a href="{{ route('tickets.listconsumable') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_consumables') }}</span>
                <span class="flex-shrink-0 badge badge-center bg-danger w-px-20 h-px-20">{{ $count }}</span>
              </a>
            </li>

            <!-- 3- Asset & Site Management -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('messages.sm_assetsitemgt') }}</span></li>
            <li class="menu-item {{ request()->routeIs('equipments.listasset*') ? 'active' : '' }}">
              <a href="{{ route('equipments.listasset') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-compass"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_asset') }}</span>
              </a>
            </li>

            <!-- 4- User Management -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('messages.sm_usermgt') }}</span></li>
            <li class="menu-item {{ request()->routeIs('reportingpersons.listreportingperson*') ? 'active' : '' }}">
              <a href="{{ route('reportingpersons.listreportingperson') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_rprtpers') }}</span>
              </a>
            </li>

            <!-- 5- Knowledge Management -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('messages.sm_knowledgemgt') }}</span></li>
            <li class="menu-item {{ request()->routeIs('knowledgebases.listknowledgebase*') ? 'active' : '' }}">
              <a href="{{ route('knowledgebases.listknowledgebase') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-info-circle"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_kb') }}</span>
              </a>
            </li>

            <!-- 6- Others -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('messages.sm_others') }}</span></li>
            <li class="menu-item {{ request()->routeIs('tickets.report.generatereport') ? 'active' : '' }}">
              <a href="{{ route('tickets.report.generatereport') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_report') }}</span>
              </a>
            </li>
          </ul>
          @endif

          <!-- /////////////////////////////////////////////////////// Site User /////////////////////////////////////////////////////// -->
          @if(Auth::user()->role_id==3)
          <ul class="menu-inner py-1">
            <!-- 1- Dashboard -->
            <li class="menu-item {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
              <a href="{{ route('dashboard.dashboarduser') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_dashboard') }}</span>
              </a>
            </li>

            <!-- 2- Issue Tracking -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">{{ __('messages.sm_tracking') }}</span>
            </li>
            <li class="menu-item {{ request()->routeIs('issues.entireissue*') ? 'active' : '' }}">
              @php
                $siteId = Auth::user()->site_id;
                $count = \App\Issue::where('site_id', $siteId)
                                          ->where('status_id', '=', 1)
                                          ->count();
              @endphp
              <a href="{{ route('issues.entireissue') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_request') }}</span>
                <span class="flex-shrink-0 badge badge-center bg-danger w-px-20 h-px-20">{{ $count }}</span>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('tickets.entireticket*') ? 'active' : '' }}">
              @php
                $siteId = Auth::user()->site_id;
                $count = \App\Ticket::whereHas('issue', function ($query) use ($siteId) {
                                                  $query->where('site_id', $siteId);
                                              })->where('ticstatus_id', '!=', 4)
                                                ->where('ticket_type', '=', 1)
                                                ->count();
              @endphp
              <a href="{{ route('tickets.entireticket') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_ticket') }}</span>
                <span class="flex-shrink-0 badge badge-center bg-danger w-px-20 h-px-20">{{ $count }}</span>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('tickets.entireconsumable*') ? 'active' : '' }}">
              @php
                $siteId = Auth::user()->site_id;
                $count = \App\Ticket::whereHas('issue', function ($query) use ($siteId) {
                                                  $query->where('site_id', $siteId);
                                              })->where('ticstatus_id', '!=', 4)
                                                ->where('ticket_type', '=', 2)
                                                ->count();
              @endphp
              <a href="{{ route('tickets.entireconsumable') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_consumables') }}</span>
                <span class="flex-shrink-0 badge badge-center bg-danger w-px-20 h-px-20">{{ $count }}</span>
              </a>
            </li>

            <!-- 3- Asset Management -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('messages.sm_assetsitemgt') }}</span></li>
            <li class="menu-item {{ request()->routeIs('equipments.entireasset*') ? 'active' : '' }}">
              <a href="{{ route('equipments.entireasset') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-compass"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_asset') }}</span>
              </a>
            </li>

            <!-- 4- User Management -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('messages.sm_usermgt') }}</span></li>
            <li class="menu-item {{ request()->routeIs('reportingpersons.entirereportingperson*') ? 'active' : '' }}">
              <a href="{{ route('reportingpersons.entirereportingperson') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_rprtpers') }}</span>
              </a>
            </li>

            <!-- 5- Knowledge Management -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('messages.sm_knowledgemgt') }}</span></li>
            <li class="menu-item {{ request()->routeIs('knowledgebases.entireknowledgebase*') ? 'active' : '' }}">
              <a href="{{ route('knowledgebases.entireknowledgebase') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-info-circle"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_kb') }}</span>
              </a>
            </li>

            <!-- 6- Others -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('messages.sm_others') }}</span></li>
            <li class="menu-item {{ request()->routeIs('tickets.report.generatereport') ? 'active' : '' }}">
              <a href="{{ route('tickets.report.generatereport') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <span class="flex-grow-1 align-middle">{{ __('messages.sm_report') }}</span>
              </a>
            </li>
          </ul>
          @endif
        </aside>
        <!-- / Menu -->
        <!-- //------------------------------------------------------------------------------------------ -->
        <!-- Layout container -->
        <div class="layout-page">

          <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <!-- <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Search..."
                    aria-label="Search..." />
                </div>
              </div> -->
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->

                <!-- Switch Languages -->
                <form method="post" action="{{ route('language.switch') }}">
                    @csrf
                    <select name="locale" onchange="this.form.submit()">
                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                        <option value="ms" {{ app()->getLocale() == 'ms' ? 'selected' : '' }}>Bahasa Melayu</option>
                    </select>
                </form>

                <!-- Notification -->
                @if(Auth::user()->role_id==1)
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <i class="bx bx-bell bx-sm"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">{{ Auth::user()->unreadNotifications->count() }}</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end py-0" style="max-height: 400px; overflow-y: auto; min-width: 350px;">
                    @if(Auth::user()->unreadNotifications)
                    <li class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h5 class="text-body mb-0 me-auto">Notification</h5>
                        <a href="{{ route('issues.markAsRead') }}" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="bx fs-4 bx-envelope-open"></i></a>
                      </div>
                    </li>
                    @endif
                    <li class="dropdown-notifications-list scrollable-container">
                      <ul class="list-group list-group-flush">
                        @foreach(Auth::user()->unreadNotifications as $notification)
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <!-- <a href="{{ route('issues.allissuedetail', ['issue' => $notification->data['issue_id']]) }}"
                            onclick="event.preventDefault(); document.getElementById('mark-as-read-form-{{ $notification->id }}').submit();"> -->
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <!-- <div class="avatar">
                                  <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                </div> -->
                              </div>
                              <div class="flex-grow-1">
                                <!-- <h6 class="mb-1">Charles Franklin</h6> -->
                                <p class="mb-0">{{ $notification->data['data'] }}</p>
                                <!-- <small class="text-muted">12hr ago</small> -->
                                <small class="text-muted">
                                  <script>
                                      var timestamp = '{{ $notification->created_at }}';
                                      var timeAgo = moment(timestamp).fromNow();
                                      document.write(timeAgo);
                                  </script>
                                </small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="bx bx-x"></span></a>
                                <!-- <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a> -->
                              </div>
                            </div>
                          <!-- </a> -->
                          <!-- <form id="mark-as-read-form-{{ $notification->id }}" action="{{ route('issues.markAsRead') }}" method="POST" style="display: none;">
                              @csrf
                              <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                          </form> -->
                        </li>
                        @endforeach
                        @foreach(Auth::user()->readNotifications as $notification)
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <!-- <div class="avatar">
                                <img src="{{ asset('pages/assets/img/avatars/7.png') }}" alt class="w-px-40 h-auto rounded-circle">
                              </div> -->
                            </div>
                            <div class="flex-grow-1">
                              <!-- <h6 class="mb-1">New Message ✉️</h6> -->
                              <p class="mb-0">{{ $notification->data['data'] }}</p>
                              <!-- <small class="text-muted">1h ago</small> -->
                              <small class="text-muted">
                                <script>
                                    var timestamp = '{{ $notification->created_at }}';
                                    var timeAgo = moment(timestamp).fromNow();
                                    document.write(timeAgo);
                                </script>
                              </small>
                            </div>
                            <!-- <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                            </div> -->
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </li>
                    <!-- <li class="dropdown-menu-footer border-top p-3">
                      <button class="btn btn-primary text-uppercase w-100">view all notifications</button>
                    </li> -->
                  </ul>
                </li>
                @endif

                @if(Auth::user()->role_id==2)
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <i class="bx bx-bell bx-sm"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">{{ Auth::user()->unreadNotifications->count() }}</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end py-0" style="max-height: 400px; overflow-y: auto; min-width: 350px;">
                    @if(Auth::user()->unreadNotifications)
                    <li class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h5 class="text-body mb-0 me-auto">Notification</h5>
                        <a href="{{ route('issues.markAsRead') }}" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="bx fs-4 bx-envelope-open"></i></a>
                      </div>
                    </li>
                    @endif
                    <li class="dropdown-notifications-list scrollable-container">
                      <ul class="list-group list-group-flush">
                        @foreach(Auth::user()->unreadNotifications as $notification)
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <!-- <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                              </div> -->
                            </div>
                            <div class="flex-grow-1">
                              <!-- <h6 class="mb-1">Charles Franklin</h6> -->
                              <p class="mb-0">{{ $notification->data['data'] }}</p>
                              <!-- <small class="text-muted">12hr ago</small> -->
                              <small class="text-muted">
                                  <script>
                                      var timestamp = '{{ $notification->created_at }}';
                                      var timeAgo = moment(timestamp).fromNow();
                                      document.write(timeAgo);
                                  </script>
                                </small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <!-- <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a> -->
                            </div>
                          </div>
                        </li>
                        @endforeach
                        @foreach(Auth::user()->readNotifications as $notification)
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <!-- <div class="avatar">
                                <img src="{{ asset('pages/assets/img/avatars/7.png') }}" alt class="w-px-40 h-auto rounded-circle">
                              </div> -->
                            </div>
                            <div class="flex-grow-1">
                              <!-- <h6 class="mb-1">New Message ✉️</h6> -->
                              <p class="mb-0">{{ $notification->data['data'] }}</p>
                              <!-- <small class="text-muted">1h ago</small> -->
                              <small class="text-muted">
                                  <script>
                                      var timestamp = '{{ $notification->created_at }}';
                                      var timeAgo = moment(timestamp).fromNow();
                                      document.write(timeAgo);
                                  </script>
                                </small>
                            </div>
                            <!-- <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                            </div> -->
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </li>
                    <!-- <li class="dropdown-menu-footer border-top p-3">
                      <button class="btn btn-primary text-uppercase w-100">view all notifications</button>
                    </li> -->
                  </ul>
                </li>
                @endif

                @if(Auth::user()->role_id==3)
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <i class="bx bx-bell bx-sm"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">{{ Auth::user()->unreadNotifications->count() }}</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end py-0" style="max-height: 400px; overflow-y: auto; min-width: 350px;">
                    @if(Auth::user()->unreadNotifications)
                    <li class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h5 class="text-body mb-0 me-auto">Notification</h5>
                        <a href="{{ route('issues.markAsRead') }}" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="bx fs-4 bx-envelope-open"></i></a>
                      </div>
                    </li>
                    @endif
                    <li class="dropdown-notifications-list scrollable-container">
                      <ul class="list-group list-group-flush">
                        @foreach(Auth::user()->unreadNotifications as $notification)
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <!-- <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                              </div> -->
                            </div>
                            <div class="flex-grow-1">
                              <!-- <h6 class="mb-1">Charles Franklin</h6> -->
                              <p class="mb-0">{{ $notification->data['data'] }}</p>
                              <!-- <small class="text-muted">12hr ago</small> -->
                              <small class="text-muted">
                                <script>
                                    var timestamp = '{{ $notification->created_at }}';
                                    var timeAgo = moment(timestamp).fromNow();
                                    document.write(timeAgo);
                                </script>
                              </small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                            </div>
                          </div>
                        </li>
                        @endforeach
                        @foreach(Auth::user()->readNotifications as $notification)
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <!-- <div class="avatar">
                                <img src="{{ asset('pages/assets/img/avatars/7.png') }}" alt class="w-px-40 h-auto rounded-circle">
                              </div> -->
                            </div>
                            <div class="flex-grow-1">
                              <!-- <h6 class="mb-1">New Message ✉️</h6> -->
                              <p class="mb-0">{{ $notification->data['data'] }}</p>
                              <!-- <small class="text-muted">1h ago</small> -->
                              <small class="text-muted">
                                <script>
                                    var timestamp = '{{ $notification->created_at }}';
                                    var timeAgo = moment(timestamp).fromNow();
                                    document.write(timeAgo);
                                </script>
                              </small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </li>
                    <!-- <li class="dropdown-menu-footer border-top p-3">
                      <button class="btn btn-primary text-uppercase w-100">view all notifications</button>
                    </li> -->
                  </ul>
                </li>
                @endif
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar">
                      <img src="{{ asset('pages/assets/img/avatars/atm.svg') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar">
                              <img src="{{ asset('pages/assets/img/avatars/atm.svg') }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block">{{ Auth::user()->fullname }}</span>
                            <small class="text-muted">{{ Auth::user()->role->role_name }} - {{ Auth::user()->site->site_name }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <!-- @if(Auth::user()->role_id==1)
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('auth.passwords.reset') }}">
                        <i class="bx bx-key me-2"></i>
                        <span class="align-middle">Reset Password</span>
                      </a>
                    </li>
                    @endif -->
                    <!-- <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li> -->
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <!-- <li>
                      <a class="dropdown-item" href="{{ route('errors.pagenotfound') }}">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">{{ __('messages.page_error') }}</span>
                      </a>
                    </li> -->
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="confirmLogout(); return false;">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">{{ __('messages.logout') }}</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- <div class="row"> -->
              @yield('content')
                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <!-- Here -->
                    
                  </div>
                </div>
                
                
              <!-- </div> -->

              <!-- <div class="row"> -->
                <!-- Here -->                
              <!-- </div> -->

            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                {{ __('messages.footer_copyright') }} ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  <a href="#" target="_blank" class="footer-link fw-medium"> Sapura Secured Technologies</a>. {{ __('messages.footer_reserved') }}.
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- //------------------------------------------------------------------------------------------ -->
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Chatbot -->
    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('pages/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('pages/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('pages/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('pages/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('pages/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('pages/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('pages/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('pages/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Chatbot JS -->
    <!-- <script src="{{asset('js/botchat2.js')}}"></script> -->
    
    <!-- Page refresh -->
    <!-- <script>
        window.onload = function () {
            setTimeout(function() => {
                window.location.reload(10); //10 second
            }, 5000);
        }
    </script> -->
        

    

    <!-- Logout JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
      function confirmLogout() {
          Swal.fire({
              title: 'Ready to Leave?',
              text: 'You will be logged out!',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, log me out!'
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById('logout-form').submit();
              }
          });
      }
    </script> -->

    <!-- Toastr -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" 
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" 
            crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    @yield('scriptlibraries')

    <!-- Date Range Picker -->
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script type="text/javascript">
      $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMM DD, YYYY') + ' - ' + end.format('MMM DD, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        // Update the form inputs on date range change
        // $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        //     $('#start_date').val(picker.startDate.format('YYYY-MM-DD'));
        //     $('#end_date').val(picker.endDate.format('YYYY-MM-DD'));
        // }); 

      });
    </script> -->

  </body>
</html>
