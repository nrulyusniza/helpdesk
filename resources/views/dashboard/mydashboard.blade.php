@extends('layouts.template')
@section('title', 'Dashboard')
@section('content')

<div class="col-lg-12 mb-4 order-0">
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

<!-- Cards & Charts-->
<div class="row g-4 mb-4">

  <!-- 1 -->
  <div class="col-sm-6 col-xl-3">
    <a href="">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">Tickets</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $tickets }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-primary">
                <i class="bx bx-card bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 2 -->
  <div class="col-sm-6 col-xl-3">
    <a href="">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">Open</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $allTixOpen }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-success">
                <i class="bx bx-lock-open bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 3 -->
  <div class="col-sm-6 col-xl-3">
    <a href="">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">Closed</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $allTixClosed }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-danger">
                <i class="bx bx-lock bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 4 -->
  <div class="col-sm-6 col-xl-3">
    <a href="">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">KIV</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $allTixKiv }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-warning">
                <i class="bx bx-archive bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 5 -->
  <div class="col-sm-6 col-xl-3">
    <a href="{{ route('knowledgebases.allknowledgebase') }}">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">Knowledge Base</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $knowledgebases }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class="bx bx-info-circle bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 6 -->
  <div class="col-sm-6 col-xl-3">
    <a href="{{ route('users.alluser') }}">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">Users</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $users }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class="bx bx-user bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 7 -->
  <div class="col-sm-6 col-xl-3">
    <a href="{{ route('sites.allsite') }}">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">Sites</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $sites }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class="bx bx-map-pin bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 8 -->
  <div class="col-sm-6 col-xl-3">
    <a href="{{ route('equipments.allasset') }}">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">Assets</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $equipments }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class="bx bx-compass bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- Total Ticket by Months -->
  <div class="col-xl-7 col-lg-7">
    <div class="card h-100">
      <div class="card-header">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Total Tickets</h5>
        </div>
      </div>
      <div class="card-body px-0">
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
            <!--
            <div class="d-flex p-4 pt-3">
              <div class="avatar flex-shrink-0 me-3">
                <img src="../assets/img/icons/unicons/wallet.png" alt="User" />
              </div>
              <div>
                <small class="text-muted d-block">Total Balance</small>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-1">$459.10</h6>
                  <small class="text-success fw-medium">
                    <i class="bx bx-chevron-up"></i>
                    42.9%
                  </small>
                </div>
              </div>
            </div> -->
            <div id="incomeChart"></div>
            <div class="d-flex justify-content-center pt-4 gap-2">
              <div class="flex-shrink-0">
                <div id="expensesOfWeek"></div>
              </div>
              <div>
                <!--
                <p class="mb-n1 mt-1">Expenses This Week</p>
                <small class="text-muted">$39 less than last week</small> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tickets based on Category -->
  <div class="col-xl-5 col-lg-5">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Category (Testing: Issue)</h5>
          <!--
          <small class="text-muted">42.82k Total Sales</small> -->
        </div>
        <!--
        <div class="dropdown">
          <button
            class="btn p-0"
            type="button"
            id="orederStatistics"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
          </div>
        </div> -->
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex flex-column align-items-center gap-1">
            <h2 class="mb-2">{{ $issues }}</h2>
            <span>Total Tickets</span>
          </div>
          <div id="orderStatisticsChart"></div>
        </div>
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-wrench"></i
              ></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Hardware</h6>
              </div>
              <div class="user-progress">
                <small class="fw-medium">{{ $totalTicketHardware }}</small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-success"><i class="bx bx-code-alt"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Software</h6>
              </div>
              <div class="user-progress">
                <small class="fw-medium">{{ $totalTicketSoftware }}</small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-info"><i class="bx bx-signal-5"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Network</h6>
              </div>
              <div class="user-progress">
                <small class="fw-medium">{{ $totalTicketNetwork }}</small>
              </div>
            </div>
          </li>
          <li class="d-flex">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-data"></i
              ></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Non-System</h6>
              </div>
              <div class="user-progress">
                <small class="fw-medium">{{ $totalTicketNonsystem }}</small>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>

</div>
@endsection