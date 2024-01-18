@extends('layouts.template')
@section('title', 'Extension')
@section('content')

<div class="row g-4 mb-4">

  <!-- 1 -->
  <div class="col-sm-6 col-xl-3">
    <a href="{{ route('types.allrequesttype') }}">
      <div class="card">
        <img class="card-img-top" src="{{ asset('pages/assets/img/illustrations/ext-request-type.png') }}" alt="Card image cap" />
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">{{ __('messages.request_type') }}</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $types }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class="bx bx-terminal bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 2 -->
  <div class="col-sm-6 col-xl-3">
    <a href="{{ route('reqcategorys.allreqcategory') }}">
      <div class="card">
        <img class="card-img-top" src="{{ asset('pages/assets/img/illustrations/ext-request-category.png') }}" alt="Card image cap" />
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">{{ __('messages.request_category') }}</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $reqcategorys }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class="bx bx-category-alt bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 3 -->
  <div class="col-sm-6 col-xl-3">
    <a href="{{ route('severitys.allseverity') }}">
      <div class="card">
        <img class="card-img-top" src="{{ asset('pages/assets/img/illustrations/ext-severity.png') }}" alt="Card image cap" />
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">{{ __('messages.severity') }}</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $severitys }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class="bx bx-pulse bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 4 -->
  <div class="col-sm-6 col-xl-3">
    <a href="{{ route('statuss.allstatus') }}">
      <div class="card">
        <img class="card-img-top" src="{{ asset('pages/assets/img/illustrations/ext-status.png') }}" alt="Card image cap" />
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">{{ __('messages.request_status') }}</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $statuss }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class="bx bx-line-chart-down bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 5 -->
  <div class="col-sm-6 col-xl-3">
    <a href="{{ route('reactions.allresponsetype') }}">
      <div class="card">
        <img class="card-img-top" src="{{ asset('pages/assets/img/illustrations/ext-response-type.png') }}" alt="Card image cap" />
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">{{ __('messages.response_type') }}</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $reactions }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class="bx bx-devices bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 6 -->
  <div class="col-sm-6 col-xl-3">
    <a href="{{ route('kbcategorys.allkbcategory') }}">
      <div class="card">
        <img class="card-img-top" src="{{ asset('pages/assets/img/illustrations/ext-kb-category.png') }}" alt="Card image cap" />
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">{{ __('messages.category_kb') }}</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $kbcategorys }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class="bx bx-category bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 7 -->
  <div class="col-sm-6 col-xl-3">
    <a href="{{ route('ticstatuss.allticstatus') }}">
      <div class="card">
        <img class="card-img-top" src="{{ asset('pages/assets/img/illustrations/ext-kb-category.png') }}" alt="Card image cap" />
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">{{ __('messages.ticket_status') }}</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $ticstatuss }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class="bx bx-category bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- 8 -->
  <div class="col-sm-6 col-xl-3">
    <a href="{{ route('equipmentstatuss.allequipmentstatus') }}">
      <div class="card">
        <img class="card-img-top" src="{{ asset('pages/assets/img/illustrations/ext-kb-category.png') }}" alt="Card image cap" />
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span class="fw-medium d-block mb-1">{{ __('messages.equipment_status') }}</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">{{ $equipmentstatuss }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class="bx bx-category bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

</div>
@endsection