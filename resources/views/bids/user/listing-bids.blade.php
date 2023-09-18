@extends('partials.app')
@section('title', 'Listing Bids')
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Listing Bids'])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'bidding'])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="table-title-area">
                    <h3>Listing Bids</h3>
                    <select style="display: none;">
                        <option value="01">Show: Last 05 Order</option>
                        <option value="02">Show: Last 03 Order</option>
                        <option value="03">Show: Last 15 Order</option>
                        <option value="04">Show: Last 20 Order</option>
                    </select>
                    <div class="nice-select" tabindex="0">
                        <span class="current">Show: Last 05 Order</span>
                        <ul class="list">
                            <li data-value="01" class="option selected">Show: Last 05 Order</li>
                            <li data-value="02" class="option">Show: Last 03 Order</li>
                            <li data-value="03" class="option">Show: Last 15 Order</li>
                            <li data-value="04" class="option">Show: Last 20 Order</li>
                        </ul>
                    </div>
                    </div>
                    <div class="table-wrapper">
                    <table class="eg-table order-table table mb-0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Bidding ID</th>
                                <th>Bid Amount(USD)</th>
                                <th>Highest Bid</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="Image"><img alt="image" src="assets/images/bg/order1.png" class="img-fluid"></td>
                                <td data-label="Bidding ID">Bidding_HvO253gT</td>
                                <td data-label="Bid Amount(USD)">1222.8955</td>
                                <td data-label="Highest Bid">$1222.8955</td>
                                <td data-label="Status" class="text-green">Approved</td>
                                <td data-label="Action"><button class="eg-btn action-btn green"><img alt="image" src="assets/images/icons/aiction-icon.svg"></button></td>
                            </tr>
                            <tr>
                                <td data-label="Image"><img alt="image" src="assets/images/bg/order2.png" class="img-fluid"></td>
                                <td data-label="Bidding ID">Bidding_HvO253gT</td>
                                <td data-label="Bid Amount(USD)">1222.8955</td>
                                <td data-label="Highest Bid">$1222.8955</td>
                                <td data-label="Status" class="text-green">Approved</td>
                                <td data-label="Action"><button class="eg-btn action-btn green"><img alt="image" src="assets/images/icons/aiction-icon.svg"></button></td>
                            </tr>
                            <tr>
                                <td data-label="Image"><img alt="image" src="assets/images/bg/order3.png" class="img-fluid"></td>
                                <td data-label="Bidding ID">Bidding_HvO253gT</td>
                                <td data-label="Bid Amount(USD)">1222.8955</td>
                                <td data-label="Highest Bid">$1222.8955</td>
                                <td data-label="Status" class="text-green">Approved</td>
                                <td data-label="Action"><button class="eg-btn action-btn green"><img alt="image" src="assets/images/icons/aiction-icon.svg"></button></td>
                            </tr>
                            <tr>
                                <td data-label="Image"><img alt="image" src="assets/images/bg/order4.png" class="img-fluid"></td>
                                <td data-label="Bidding ID">Bidding_HvO253gT</td>
                                <td data-label="Bid Amount(USD)">1222.8955</td>
                                <td data-label="Highest Bid">$1222.8955</td>
                                <td data-label="Status" class="text-green">Approved</td>
                                <td data-label="Action"><button class="eg-btn action-btn green"><img alt="image" src="assets/images/icons/aiction-icon.svg"></button></td>
                            </tr>
                            <tr>
                                <td data-label="Image"><img alt="image" src="assets/images/bg/order1.png" class="img-fluid"></td>
                                <td data-label="Bidding ID">Bidding_HvO253gT</td>
                                <td data-label="Bid Amount(USD)">1222.8955</td>
                                <td data-label="Highest Bid">$1222.8955</td>
                                <td data-label="Status" class="text-green">Approved</td>
                                <td data-label="Action"><button class="eg-btn action-btn green"><img alt="image" src="assets/images/icons/aiction-icon.svg"></button></td>
                            </tr>
                            <tr>
                                <td data-label="Image"><img alt="image" src="assets/images/bg/order1.png" class="img-fluid"></td>
                                <td data-label="Bidding ID">Bidding_HvO253gT</td>
                                <td data-label="Bid Amount(USD)">1222.8955</td>
                                <td data-label="Highest Bid">$1222.8955</td>
                                <td data-label="Status" class="text-green">Approved</td>
                                <td data-label="Action"><button class="eg-btn action-btn green"><img alt="image" src="assets/images/icons/aiction-icon.svg"></button></td>
                            </tr>
                            <tr>
                                <td data-label="Image"><img alt="image" src="assets/images/bg/order2.png"></td>
                                <td data-label="Bidding ID">Bidding_HvO253gT</td>
                                <td data-label="Bid Amount(USD)">1222.8955</td>
                                <td data-label="Highest Bid">$6622.8955</td>
                                <td data-label="Status" class="text-red">Reject</td>
                                <td data-label="Action"><button class="eg-btn action-btn red"><img alt="image" src="assets/images/icons/aiction-icon.svg"></button></td>
                            </tr>
                            <tr>
                                <td data-label="Image"><img alt="image" src="assets/images/bg/order3.png"></td>
                                <td data-label="Bidding ID">Bidding_HvO253gT</td>
                                <td data-label="Bid Amount(USD)">1222.8955</td>
                                <td data-label="Highest Bid">$9022.8955</td>
                                <td data-label="Status" class="text-green">Approved</td>
                                <td data-label="Action"><button class="eg-btn action-btn green"><img alt="image" src="assets/images/icons/aiction-icon.svg"></button></td>
                            </tr>
                            <tr>
                                <td data-label="Image"><img alt="image" src="assets/images/bg/order4.png"></td>
                                <td data-label="Bidding ID">Bidding_HvO253gT</td>
                                <td data-label="Bid Amount(USD)">1222.8955</td>
                                <td data-label="Highest Bid">$9022.8955</td>
                                <td data-label="Status" class="text-red">Reject</td>
                                <td data-label="Action"><button class="eg-btn action-btn red"><img alt="image" src="assets/images/icons/aiction-icon.svg"></button></td>
                            </tr>
                            <tr>
                                <td data-label="Image"><img alt="image" src="assets/images/bg/order5.png"></td>
                                <td data-label="Bidding ID">Bidding_HvO253gT</td>
                                <td data-label="Bid Amount(USD)">1222.8955</td>
                                <td data-label="Highest Bid">$9022.8955</td>
                                <td data-label="Status" class="text-green">Approved</td>
                                <td data-label="Action"><button class="eg-btn action-btn green"><img alt="image" src="assets/images/icons/aiction-icon.svg"></button></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <div class="table-pagination">
                    <p>Showing 10 to 20 of 1 entries</p>
                    <nav class="pagination-wrap">
                        <ul class="pagination style-two d-flex justify-content-center gap-md-3 gap-2">
                            <li class="page-item">
                                <a class="page-link" href="#" tabindex="-1">Prev</a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">01</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">02</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">03</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                    </div>
                </div>
          </div>
        </div>
    </div>
</div>

@include('layouts.metrics')

@endsection