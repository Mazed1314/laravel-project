@extends('layout.app')
@section('pageTitle',trans('Dashboard'))

@section('content')

<div class="row" >
      <div class="col-12">
        <div class="col-sm-4  ">
          <span class="count_top"><i class="fa fa-user"></i> Total Sales</span>
          <div class="count">{{$sales}}</div>
        </div>
        <div class="col-sm-4  ">
          <span class="count_top"><i class="fa fa-user"></i> Total Purchase</span>
          <div class="count">{{$purchase}}</div>
        </div>
        <div class="col-sm-4  ">
          <span class="count_top"><i class="fa fa-user"></i> Available Stock</span>
          <div class="count green">{{$stock}}</div>
        </div>
      </div>
</div>
@endsection

@push('scripts')

<!-- Need: Apexcharts -->
<script src="{{ asset('/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('/assets/js/pages/dashboard.js') }}"></script>
@endpush