@extends('partials.admin')
@section('title', 'Admin Dashboard')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'dashboard'])

<div class="main-content app-content mt-0">
  <div class="side-app">

    <!-- CONTAINER -->
    <div class="main-container container-fluid">
      @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Dashboard'])

      <!-- ROW-1 -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
              <div class="card overflow-hidden">
                <div class="card-body">
                  <div class="d-flex">
                    <div class="mt-2">
                      <h6 class="">Total Users</h6>
                      <h2 class="mb-0 number-font">{{ numbers_to_human($metrics['total_users']['total']) }}</h2>
                    </div>
                    <div class="ms-auto">
                      <div class="chart-wrapper mt-1">
                        <canvas id="userchart" class="h-8 w-9 chart-dropshadow"></canvas>
                      </div>
                    </div>
                  </div>
                  <span class="text-muted fs-12"><span class="text-secondary"> <i
                        class="fa-regular fa-circle-arrow-up text-secondary"></i> {{
                      $metrics['total_users']['increase_percentage'] }}% </span>
                    Last week</span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
              <div class="card overflow-hidden">
                <div class="card-body">
                  <div class="d-flex">
                    <div class="mt-2">
                      <h6 class="">Total Ads</h6>
                      <h2 class="mb-0 number-font">{{ numbers_to_human($metrics['total_ads']['total']) }}</h2>
                    </div>
                    <div class="ms-auto">
                      <div class="chart-wrapper mt-1">
                        <canvas id="adschart" class="h-8 w-9 chart-dropshadow"></canvas>
                      </div>
                    </div>
                  </div>
                  <span class="text-muted fs-12"><span class="text-pink">
                      <i class="fa-regular fa-circle-arrow-up text-pink"></i> {{
                      $metrics['total_ads']['increase_percentage'] }}%</span>
                    Last 15 days</span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
              <div class="card overflow-hidden">
                <div class="card-body">
                  <div class="d-flex">
                    <div class="mt-2">
                      <h6 class="">Total Bids</h6>
                      <h2 class="mb-0 number-font">{{ numbers_to_human($metrics['total_bids']['total']) }}</h2>
                    </div>
                    <div class="ms-auto">
                      <div class="chart-wrapper mt-1">
                        <canvas id="bidschart" class="h-8 w-9 chart-dropshadow"></canvas>
                      </div>
                    </div>
                  </div>
                  <span class="text-muted fs-12"><span class="text-green"> <i
                        class="fa-regular fa-circle-arrow-up text-green"></i> {{
                      $metrics['total_bids']['increase_percentage'] }}%</span>
                    Last week</span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
              <div class="card overflow-hidden">
                <div class="card-body">
                  <div class="d-flex">
                    <div class="mt-2">
                      <h6 class="">Total Transaction</h6>
                      <h2 class="mb-0 number-font">{{ money($metrics['total_transactions']['total'], true) }}</h2>
                    </div>
                    <div class="ms-auto">
                      <div class="chart-wrapper mt-1">
                        <canvas id="transactionschart" class="h-8 w-9 chart-dropshadow"></canvas>
                      </div>
                    </div>
                  </div>
                  <span class="text-muted fs-12"><span class="text-warning"> <i
                        class="fa-regular fa-circle-arrow-up text-warning"></i> {{
                      $metrics['total_transactions']['increase_percentage'] }}%</span>
                    Last 20 days</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ROW-1 END -->

      <!-- ROW-2 -->
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Bid & Ad Analytics</h3>
            </div>
            <div class="card-body">
              <div class="d-flex mx-auto text-center justify-content-center mb-4">
                <div class="d-flex text-center justify-content-center me-3"><span
                    class="dot-label bg-primary my-auto"></span>Total Bid</div>
                <div class="d-flex text-center justify-content-center"><span
                    class="dot-label bg-secondary my-auto"></span>Total Payments</div>
              </div>
              <div class="chartjs-wrapper-demo">
                <canvas id="bids-ads" class="chart-dropshadow"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ROW-2 END -->

      <!-- ROW-4 -->
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Payment Analytics</h3>
              </div>
              <div class="card-body">
                  <div class="chart-container">
                      <canvas id="payment-analytics" class="h-275"></canvas>
                  </div>
              </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Top Locations</h3>
              </div>
              <div class="card-body">
                  <div class="chart-container">
                      <canvas id="location-donut" class="h-275"></canvas>
                  </div>
              </div>
          </div>
        </div>
      </div>
      <!-- ROW-4 END -->
    </div>
    <!-- CONTAINER END -->
  </div>
</div>


@endsection
@push('scripts')
<script src="/plugin/chart/Chart.bundle.js"></script>
<script src="/plugin/chart/utils.js"></script>
<script src="/assets/js/dashboard.js"></script>
<script>
  var ctx = document.getElementById('userchart').getContext('2d');
  createUserBarChart(
    ctx, 
    {!! json_encode($metrics['total_users']['chart']['labels'], JSON_UNESCAPED_SLASHES) !!}, 
    {!! json_encode($metrics['total_users']['chart']['data'], JSON_UNESCAPED_SLASHES) !!}
  );

  createAdsLineChart(
    document.getElementById('adschart').getContext('2d'), 
    {!! json_encode($metrics['total_ads']['chart']['labels'], JSON_UNESCAPED_SLASHES) !!}, 
    {!! json_encode($metrics['total_ads']['chart']['data'], JSON_UNESCAPED_SLASHES) !!}
  );

  createBidsBarChart(
    document.getElementById('bidschart').getContext('2d'), 
    {!! json_encode($metrics['total_bids']['chart']['labels'], JSON_UNESCAPED_SLASHES) !!}, 
    {!! json_encode($metrics['total_bids']['chart']['data'], JSON_UNESCAPED_SLASHES) !!}
  );

  createTransactionsLineChart(
    document.getElementById('transactionschart').getContext('2d'), 
    {!! json_encode($metrics['total_transactions']['chart']['labels'], JSON_UNESCAPED_SLASHES) !!}, 
    {!! json_encode($metrics['total_transactions']['chart']['data'], JSON_UNESCAPED_SLASHES) !!}
  );

  createPaymentsBarChart(
    document.getElementById('payment-analytics').getContext('2d'), 
    {!! json_encode($metrics['payment_analytics']['labels'], JSON_UNESCAPED_SLASHES) !!}, 
    {!! json_encode($metrics['payment_analytics']['data'], JSON_UNESCAPED_SLASHES) !!}
  );

  createLocationChart(
    document.getElementById('location-donut').getContext('2d'), 
    {!! json_encode($metrics['location_analytics']['labels'], JSON_UNESCAPED_SLASHES) !!}, 
    {!! json_encode($metrics['location_analytics']['data'], JSON_UNESCAPED_SLASHES) !!}
  );

  createTransactionChart(
    {!! json_encode($metrics['yearly_analytics']['labels'], JSON_UNESCAPED_SLASHES) !!}, 
    {!! json_encode($metrics['yearly_analytics']['data']['bids'], JSON_UNESCAPED_SLASHES) !!}, 
    {!! json_encode($metrics['yearly_analytics']['data']['ads'], JSON_UNESCAPED_SLASHES) !!}, 
  )

</script>

@endpush