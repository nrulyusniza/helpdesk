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

<!-- Cards -->
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
                <h4 class="mb-0 me-2">{{ $totalTickets }}</h4>
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
                <h4 class="mb-0 me-2">{{ $openTickets }}</h4>
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
                <h4 class="mb-0 me-2">{{ $closedTickets }}</h4>
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
                <h4 class="mb-0 me-2">{{ $kivTickets }}</h4>
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

  <!-- Total Ticket by Months -->
  <div class="col-xl-7 col-lg-7">
    <div class="card h-100">
      <div class="card-header">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Total Tickets</h5>
        </div>
      </div>
      <div class="card-body px-0">
        <!-- <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="nav-ticketByMonth"> -->
            <canvas id="ticketByMonth"></canvas>
          <!-- </div>
        </div> -->
      </div>
    </div>
  </div>

  <!-- Tickets based on Category -->
  <div class="col-xl-5 col-lg-5">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Category</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex flex-column align-items-center gap-1">
            <h2 class="mb-2">{{ $ttlTickets }}</h2>
            <span>Total Tickets</span>
          </div>
          <div id="ticketByCategory"></div>
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
                <small class="fw-medium">{{ $hardwareTickets }}</small>
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
                <small class="fw-medium">{{ $softwareTickets }}</small>
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
                <small class="fw-medium">{{ $networkTickets }}</small>
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
                <small class="fw-medium">{{ $nonsystemTickets }}</small>
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
      // Sample data (replace this with your actual data)
      const ticketCountsByMonth = [10, 30, 0, 20, 15, 35, 10, 10, 10, 40, 60, 65];
      // const ticketCountsByMonth = @json($monthlyTicketCounts);

      // Get the canvas element and create a 2d context
      const ticketByMonthCanvas = document.getElementById('ticketByMonth');
      const ctx = ticketByMonthCanvas.getContext('2d');

      // Create the area chart
      const ticketByMonth = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [{
            label: 'Total Tickets',
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
        series: [{{ $hardwareTickets }}, {{ $softwareTickets }}, {{ $networkTickets }}, {{ $nonsystemTickets }}],
        labels: ['Hardware', 'Software', 'Network', 'Non-System'],
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