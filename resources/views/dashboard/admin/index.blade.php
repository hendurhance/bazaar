@extends('partials.admin')
@section('title', 'Admin Dashboard')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true])

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
                      <h2 class="mb-0 number-font">44,278</h2>
                    </div>
                    <div class="ms-auto">
                      <div class="chart-wrapper mt-1">
                        <canvas id="saleschart" class="h-8 w-9 chart-dropshadow"></canvas>
                      </div>
                    </div>
                  </div>
                  <span class="text-muted fs-12"><span class="text-secondary"><i
                        class="fe fe-arrow-up-circle  text-secondary"></i> 5%</span>
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
                      <h2 class="mb-0 number-font">67,987</h2>
                    </div>
                    <div class="ms-auto">
                      <div class="chart-wrapper mt-1">
                        <canvas id="leadschart" class="h-8 w-9 chart-dropshadow"></canvas>
                      </div>
                    </div>
                  </div>
                  <span class="text-muted fs-12"><span class="text-pink"><i
                        class="fe fe-arrow-down-circle text-pink"></i> 0.75%</span>
                    Last 6 days</span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
              <div class="card overflow-hidden">
                <div class="card-body">
                  <div class="d-flex">
                    <div class="mt-2">
                      <h6 class="">Total Bids</h6>
                      <h2 class="mb-0 number-font">$76,965</h2>
                    </div>
                    <div class="ms-auto">
                      <div class="chart-wrapper mt-1">
                        <canvas id="profitchart" class="h-8 w-9 chart-dropshadow"></canvas>
                      </div>
                    </div>
                  </div>
                  <span class="text-muted fs-12"><span class="text-green"><i
                        class="fe fe-arrow-up-circle text-green"></i> 0.9%</span>
                    Last 9 days</span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
              <div class="card overflow-hidden">
                <div class="card-body">
                  <div class="d-flex">
                    <div class="mt-2">
                      <h6 class="">Total Transactions</h6>
                      <h2 class="mb-0 number-font">$59,765</h2>
                    </div>
                    <div class="ms-auto">
                      <div class="chart-wrapper mt-1">
                        <canvas id="costchart" class="h-8 w-9 chart-dropshadow"></canvas>
                      </div>
                    </div>
                  </div>
                  <span class="text-muted fs-12"><span class="text-warning"><i
                        class="fe fe-arrow-up-circle text-warning"></i> 0.6%</span>
                    Last year</span>
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
              <h3 class="card-title">Sales Analytics</h3>
            </div>
            <div class="card-body">
              <div class="d-flex mx-auto text-center justify-content-center mb-4">
                <div class="d-flex text-center justify-content-center me-3"><span
                    class="dot-label bg-primary my-auto"></span>Total Sales</div>
                <div class="d-flex text-center justify-content-center"><span
                    class="dot-label bg-secondary my-auto"></span>Total Orders</div>
              </div>
              <div class="chartjs-wrapper-demo">
                <canvas id="transactions" class="chart-dropshadow"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ROW-2 END -->

      <!-- ROW-4 -->
      <div class="row">
        <div class="col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title mb-0">Ads Listing</h3>
            </div>
            <div class="card-body pt-4">
              <div class="grid-margin">
                <div class="">
                  <div class="panel panel-primary">
                    <div class="tab-menu-heading border-0 p-0">
                      <div class="tabs-menu1">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs product-sale">
                          <li><a href="#tab5" class="active" data-bs-toggle="tab">All products</a></li>
                          <li><a href="#tab6" data-bs-toggle="tab" class="text-dark">Shipped</a></li>
                          <li><a href="#tab7" data-bs-toggle="tab" class="text-dark">Pending</a></li>
                          <li><a href="#tab8" data-bs-toggle="tab" class="text-dark">Cancelled</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel-body tabs-menu-body border-0 pt-0">
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab5">
                          <div class="table-responsive">
                            <table id="data-table" class="table table-bordered text-nowrap mb-0">
                              <thead class="border-top">
                                <tr>
                                  <th class="bg-transparent border-bottom-0" style="width: 5%;">Tracking Id</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Product</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Customer</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Date</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Amount</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Payment Mode</th>
                                  <th class="bg-transparent border-bottom-0" style="width: 10%;">Status</th>
                                  <th class="bg-transparent border-bottom-0" style="width: 5%;">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #98765490</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/10.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Headsets</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cherry Blossom</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">30 Aug
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$6.721.5</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #76348798</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/12.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Flower Pot</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Simon Sais</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">15 Nov
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$35,7863</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Cancelled</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #23986456</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/4.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Pen Drive</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Manny Jah</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">27 Jan
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$5,89,6437</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #87456325</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/8.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          New Bowl</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Florinda Carasco</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">19 Sep
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$17.98</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #65783926</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/6.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Leather Watch</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Ivan Notheridiya</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">06 Oct
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$8.654.4</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Cancelled</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #34654895</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/1.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Digital Camera</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Willie Findit</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">10 Jul
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$8.654.4</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #98765345</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/11.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Earphones</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Addie Minstra</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">25 Jun
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$7,34,9768</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #67546577</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/2.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Shoes</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Laura Biding</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">22 Feb
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$7.76.654</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab6">
                          <div class="table-responsive">
                            <table class="table table-bordered text-nowrap mb-0">
                              <thead class="border-top">
                                <tr>
                                  <th class="bg-transparent border-bottom-0" style="width: 5%;">Tracking Id</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Product</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Customer</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Date</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Amount</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Payment Mode</th>
                                  <th class="bg-transparent border-bottom-0" style="width: 10%;">Status</th>
                                  <th class="bg-transparent border-bottom-0" style="width: 5%;">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #98765490</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/10.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Headsets</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cherry Blossom</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">30 Aug
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$6.721.5</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #76348798</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/12.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Flower Pot</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Simon Sais</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">15 Nov
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$35,7863</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #23986456</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/4.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Pen Drive</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Manny Jah</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">27 Jan
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$5,89,6437</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #87456325</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/8.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          New Bowl</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Florinda Carasco</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">19 Sep
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$17.98</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #65783926</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/6.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Leather Watch</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Ivan Notheridiya</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">06 Oct
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$8.654.4</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #34654895</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/1.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Digital Camera</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Willie Findit</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">10 Jul
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$8.654.4</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #98765345</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/11.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Earphones</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Addie Minstra</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">25 Jun
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$7,34,9768</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #67546577</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/2.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Shoes</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Laura Biding</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">22 Feb
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$7.76.654</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Shipped</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab7">
                          <div class="table-responsive">
                            <table class="table table-bordered text-nowrap mb-0">
                              <thead class="border-top">
                                <tr>
                                  <th class="bg-transparent border-bottom-0" style="width: 5%;">Tracking Id</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Product</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Customer</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Date</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Amount</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Payment Mode</th>
                                  <th class="bg-transparent border-bottom-0" style="width: 10%;">Status</th>
                                  <th class="bg-transparent border-bottom-0" style="width: 5%;">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #98765490</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/10.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Headsets</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cherry Blossom</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">30 Aug
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$6.721.5</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #23986456</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/4.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Pen Drive</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Manny Jah</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">27 Jan
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$5,89,6437</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #87456325</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/8.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          New Bowl</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Florinda Carasco</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">19 Sep
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$17.98</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #65783926</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/6.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Leather Watch</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Ivan Notheridiya</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">06 Oct
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$8.654.4</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #34654895</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/1.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Digital Camera</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Willie Findit</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">10 Jul
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$8.654.4</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #98765345</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/11.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Earphones</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Addie Minstra</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">25 Jun
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$7,34,9768</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #67546577</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/2.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Shoes</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Laura Biding</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">22 Feb
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$7.76.654</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Pending</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab8">
                          <div class="table-responsive">
                            <table class="table table-bordered text-nowrap mb-0">
                              <thead class="border-top">
                                <tr>
                                  <th class="bg-transparent border-bottom-0" style="width: 5%;">Tracking Id</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Product</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Customer</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Date</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Amount</th>
                                  <th class="bg-transparent border-bottom-0">
                                    Payment Mode</th>
                                  <th class="bg-transparent border-bottom-0" style="width: 10%;">Status</th>
                                  <th class="bg-transparent border-bottom-0" style="width: 5%;">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #98765490</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/10.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Headsets</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cherry Blossom</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">30 Aug
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$6.721.5</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Cancelled</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #76348798</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/12.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Flower Pot</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Simon Sais</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">15 Nov
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$35,7863</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Cancelled</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #23986456</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/4.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Pen Drive</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Manny Jah</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">27 Jan
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$5,89,6437</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Cancelled</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #87456325</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/8.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          New Bowl</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Florinda Carasco</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">19 Sep
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$17.98</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Online Payment</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Cancelled</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #65783926</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/6.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Leather Watch</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Ivan Notheridiya</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">06 Oct
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$8.654.4</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Cancelled</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                                <tr class="border-bottom">
                                  <td class="text-center">
                                    <div class="mt-0 mt-sm-2 d-block">
                                      <h6 class="mb-0 fs-14 fw-semibold">
                                        #34654895</h6>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <span class="avatar bradius"
                                        style="background-image: url(../assets/images/orders/1.jpg)"></span>
                                      <div class="ms-3 mt-0 mt-sm-2 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Digital Camera</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Willie Findit</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td><span class="mt-sm-2 d-block">10 Jul
                                      2021</span></td>
                                  <td><span class="fw-semibold mt-sm-2 d-block">$8.654.4</span>
                                  </td>
                                  <td>
                                    <div class="d-flex">
                                      <div class="mt-0 mt-sm-3 d-block">
                                        <h6 class="mb-0 fs-14 fw-semibold">
                                          Cash on Delivery</h6>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="mt-sm-1 d-block">
                                      <span
                                        class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Cancelled</span>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="g-2">
                                      <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit"><span class="fe fe-edit fs-14"></span></a>
                                      <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"><span class="fe fe-trash-2 fs-14"></span></a>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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