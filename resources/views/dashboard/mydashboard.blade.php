@extends('layouts.template')
@section('title', 'Dashboard')
@section('content')

<div class="col-lg-12 mb-4 order-0">
  <div class="card">
    <div class="d-flex align-items-end row">
      <div class="col-sm-7">
        <div class="card-body">
          <h5 class="card-title text-primary">{{ __('messages.welcomeback') }}, {{ Auth::user()->fullname }}! 🎉</h5>
          <p class="mb-4">
          {{ __('messages.dboardannoucement') }}
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
    <a href="{{ route('dashboard.infohub.allticket') }}">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">{{ __('messages.cd_ticket') }}</span>
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
    <a href="{{ route('dashboard.infohub.allopen') }}">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">{{ __('messages.cd_open') }}</span>
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
    <a href="{{ route('dashboard.infohub.allclosed') }}">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">{{ __('messages.cd_closed') }}</span>
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
    <a href="{{ route('dashboard.infohub.allkiv') }}">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">{{ __('messages.cd_kiv') }}</span>
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
              <span class="fw-medium d-block mb-1">{{ __('messages.cd_kb') }}</span>
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
              <span class="fw-medium d-block mb-1">{{ __('messages.cd_user') }}</span>
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
              <span class="fw-medium d-block mb-1">{{ __('messages.cd_site') }}</span>
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
              <span class="fw-medium d-block mb-1">{{ __('messages.cd_asset') }}</span>
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
          <h5 class="m-0 me-2">{{ __('messages.title_ttltix') }}</h5>
        </div>
      </div>
      <div class="card-body px-0">
            <canvas id="ticketByMonth"></canvas>
      </div>
    </div>
  </div>

  <!-- Tickets based on Category -->
  <div class="col-xl-5 col-lg-5">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">{{ __('messages.title_cat') }}</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex flex-column align-items-center gap-1">
            <h2 class="mb-2">{{ $totalTickets }}</h2>
            <span>{{ __('messages.ttltix') }}</span>
          </div>
          <div id="ticketByCategory"></div>
        </div>
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1" style="pointer-events: none;">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-wrench"></i
              ></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">{{ __('messages.cat_hw') }}</h6>
              </div>
              <div class="user-progress">
                <small class="fw-medium">{{ $totalTicketHardware }}</small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1" style="pointer-events: none;">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-success"><i class="bx bx-code-alt"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">{{ __('messages.cat_sw') }}</h6>
              </div>
              <div class="user-progress">
                <small class="fw-medium">{{ $totalTicketSoftware }}</small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1" style="pointer-events: none;">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-signal-5"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">{{ __('messages.cat_network') }}</h6>
              </div>
              <div class="user-progress">
                <small class="fw-medium">{{ $totalTicketNetwork }}</small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1" style="pointer-events: none;">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-data"></i
              ></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">{{ __('messages.cat_nsys') }}</h6>
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

@stop

@section('scriptlibraries')

  <!-- Area Chart JS -->
  <!-- Chart.js library is included -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>  

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Use the data passed from the controller
      const ticketCountsByMonth = {!! json_encode(array_values($ticketCounts)) !!};

      const ticketByMonthCanvas = document.getElementById('ticketByMonth');
      const ctx = ticketByMonthCanvas.getContext('2d');

      const ticketByMonth = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['{{ __('messages.jan') }}', '{{ __('messages.feb') }}', '{{ __('messages.mar') }}', 
          '{{ __('messages.apr') }}', '{{ __('messages.may') }}', '{{ __('messages.jun') }}', 
          '{{ __('messages.jul') }}', '{{ __('messages.aug') }}', '{{ __('messages.sep') }}', 
          '{{ __('messages.oct') }}', '{{ __('messages.nov') }}', '{{ __('messages.dec') }}'],
          datasets: [{
            label: '{{ __('messages.ttltix') }}',
            data: ticketCountsByMonth,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderWidth: 2,
            fill: true
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              grid: {
                display: false
              }
            },
            y: {
              grid: {
                display: false
              },
              beginAtZero: true
              // ticks: {
              //   stepSize: 1,
              //   callback: function (value, index, values) {
              //       return Math.floor(value);
              //   }
              // }
            }
          }
        }
      });
    });
  </script>

  <!-- Donut Chart JS -->
  <!-- Include the ApexCharts library -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.0/dist/apexcharts.min.js"></script>

  <script>
    // Create a function to generate the donut chart
    function generateDonutChart() {
      // Define the chart options
      var options = {
        series: [{{ $totalTicketHardware }}, {{ $totalTicketSoftware }}, {{ $totalTicketNetwork }}, {{ $totalTicketNonsystem }}],
        labels: ['{{ __('messages.cat_hw') }}', '{{ __('messages.cat_sw') }}', '{{ __('messages.cat_network') }}', '{{ __('messages.cat_nsys') }}'],
        chart: {
          type: 'donut',
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
      };

      // Create the chart instance
      var chart = new ApexCharts(document.getElementById('ticketByCategory'), options);

      // Render the chart
      chart.render();
    }

    // Call the function to generate the donut chart
    generateDonutChart();
  </script>

@stop