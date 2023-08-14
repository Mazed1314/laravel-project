@extends('layout.app')
@section('pageTitle',"Dashboard")
@section('pageheader',"Dashboard")
@section('breadcrumb',"Dashboard")
@section('pageName',"Dashboard")
@push('styles')

<link rel="stylesheet" href="{{asset('public/assets/vendor/charts/chartist-bundle/chartist.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/vendor/charts/morris-bundle/morris.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/vendor/charts/c3charts/c3.css')}}">
@endpush
@section('content')
<div class="row">
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <div class="card-body">
              <h5 class="text-muted">Total Revenue</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">$12099</h1>
              </div>
              <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                  <span><i class="fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
              </div>
          </div>
          <div id="sparkline-revenue"></div>
      </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <div class="card-body">
              <h5 class="text-muted">Affiliate Revenue</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">$12099</h1>
              </div>
              <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                  <span><i class="fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
              </div>
          </div>
          <div id="sparkline-revenue2"></div>
      </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <div class="card-body">
              <h5 class="text-muted">Refunds</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">0.00</h1>
              </div>
              <div class="metric-label d-inline-block float-right text-primary font-weight-bold">
                  <span>N/A</span>
              </div>
          </div>
          <div id="sparkline-revenue3"></div>
      </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card">
          <div class="card-body">
              <h5 class="text-muted">Avg. Revenue Per User</h5>
              <div class="metric-value d-inline-block">
                  <h1 class="mb-1">$28000</h1>
              </div>
              <div class="metric-label d-inline-block float-right text-secondary font-weight-bold">
                  <span>-2.00%</span>
              </div>
          </div>
          <div id="sparkline-revenue4"></div>
      </div>
  </div>
</div>

@endsection
@push('scripts')
  <!-- chart chartist js -->
  <script src="{{asset('public/assets/vendor/charts/chartist-bundle/chartist.min.js')}}"></script>
  <!-- sparkline js -->
  <script src="{{asset('public/assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
  <!-- morris js -->
  <script src="{{asset('public/assets/vendor/charts/morris-bundle/raphael.min.js')}}"></script>
  <script src="{{asset('public/assets/vendor/charts/morris-bundle/morris.js')}}"></script>
  <!-- chart c3 js -->
  <script src="{{asset('public/assets/vendor/charts/c3charts/c3.min.js')}}"></script>
  <script src="{{asset('public/assets/vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>
  <script src="{{asset('public/assets/vendor/charts/c3charts/C3chartjs.js')}}"></script>
  <script src="{{asset('public/assets/libs/js/dashboard-ecommerce.js')}}"></script>

@endpush