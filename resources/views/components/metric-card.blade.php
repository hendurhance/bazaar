<div class="about-us-counter pb-120 {{ $class ?? '' }}">
    <div class="container">
        <div class="row g-4 d-flex justify-content-center">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 col-10">
                <div class="counter-single text-center d-flex flex-row hover-border2 wow fadeInDown"
                    data-wow-duration="1.5s" data-wow-delay="0.2s">
                    <div class="counter-icon"> <img alt="image" src="/assets/images/icons/employee.svg"> </div>
                    <div class="coundown d-flex flex-column">
                        <h3 class="odometer" data-odometer-final="{{$metrics['total_users']}}">&nbsp;</h3>
                        <p>Happy Customer</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 col-10">
                <div class="counter-single text-center d-flex flex-row hover-border2 wow fadeInDown"
                    data-wow-duration="1.5s" data-wow-delay="0.4s">
                    <div class="counter-icon"> <img alt="image" src="/assets/images/icons/ads.svg"> </div>
                    <div class="coundown d-flex flex-column">
                        <h3 class="odometer" data-odometer-final="{{$metrics['total_ads']}}">&nbsp;</h3>
                        <p>Total Ads</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 col-10">
                <div class="counter-single text-center d-flex flex-row hover-border2 wow fadeInDown"
                    data-wow-duration="1.5s" data-wow-delay="0.6s">
                    <div class="counter-icon"> <img alt="image" src="/assets/images/icons/smily.svg"> </div>
                    <div class="coundown d-flex flex-column">
                        <h3 class="odometer" data-odometer-final="{{$metrics['total_bids']}}">&nbsp;</h3>
                        <p>Total Bids</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 col-10">
                <div class="counter-single text-center d-flex flex-row hover-border2 wow fadeInDown"
                    data-wow-duration="1.5s" data-wow-delay="0.8s">
                    <div class="counter-icon"> <img alt="image" src="/assets/images/icons/bid-paid.svg"> </div>
                    <div class="coundown d-flex flex-column">
                        <h3 class="odometer" data-odometer-final="{{money($metrics['total_amount_paid'], true)}}">&nbsp;</h3>
                        <p>Bids Paid</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>