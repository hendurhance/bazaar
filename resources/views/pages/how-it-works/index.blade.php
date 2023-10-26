@extends('partials.app')
@section('title', 'How it works')
@section('description', 'How to auction on our platform')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'How it works'])

 <div class="how-work-section pt-120 pb-120">
    <div class="container">
       <div class="row g-4 mb-60">
          <div class="col-xl-6 col-lg-6">
             <div class="how-work-content wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                <span>01.</span>
                <h3>Register Now &amp; Start Selling Your Things</h3>
                <p class="para">Ready to make the most of your unused items? Dive into the world of Bazaar and transform your belongings into valuable assets. By signing up today, you'll open the door to endless possibilities. Whether it's a vintage collection gathering dust or electronics waiting for a new home, Bazaar is your platform to connect with eager buyers.</p>
                <p class="para"> List your items, craft compelling descriptions, and let captivating images do the talking. Your listings will catch the eye of enthusiasts worldwide, sparking lively auctions and profitable transactions. Register now, and let the selling journey begin.</p>
                <a href="{{ route('user.register') }}" class="eg-btn btn--primary btn--md">Register Account</a>
             </div>
          </div>
          <div class="col-xl-6 col-lg-6 d-flex justify-content-lg-end justify-content-center">
             <div class="how-work-img wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".2s"
                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                <img alt="image" src="assets/images/bg/how-work1.png" class="work-img">
             </div>
          </div>
       </div>
       <div class="row g-4 mb-60">
          <div class="col-xl-6 col-lg-6 d-flex justify-content-lg-start justify-content-center order-lg-1 order-2">
             <div class="how-work-img wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".2s"
                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                <img alt="image" src="assets/images/bg/how-work2.png" class="work-img">
             </div>
          </div>
          <div class="col-xl-6 col-lg-6 order-lg-2 order-1">
             <div class="how-work-content wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                <span>02.</span>
                <h3>Select Your Item</h3>
                <p class="para">Bazaar is your gateway to a diverse array of offerings, waiting to be explored. From the sleek contours of luxury watches to the intricate details of collectibles, each category is a treasure trove of remarkable finds.</p>
                <p class="para"> Simply choose the category that resonates with your passions, and delve into a world of listings that tell their own stories. With every description and image, you'll feel the essence of the item, making it more than just a purchase – it's an experience. Once you've found the item that speaks to you, step into the exhilarating world of bidding, where anticipation and excitement blend seamlessly.</p>
                <a href="#" class="eg-btn btn--primary btn--md">Add Your Item</a>
             </div>
          </div>
       </div>
       <div class="row g-4">
          <div class="col-xl-6 col-lg-6">
             <div class="how-work-content wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                <span>03.</span>
                <h3>Purchase Items</h3>
                <p class="para">The thrill of victory – that's what awaits you at the end of a spirited bidding battle on Bazaar. Imagine the satisfaction of being the highest bidder, claiming your desired item as your own. With each auction won, you're not just purchasing an object; you're acquiring a piece of excitement and a memory to cherish. After securing your winning bid, the next steps are effortless.</p>
                <p class="para"> Make secure payments through our trusted platform, knowing that your financial information is in safe hands. Then, as the seller makes arrangements for delivery, the countdown begins. The moment your much-awaited item arrives at your doorstep, it's a celebration of your successful bidding journey.</p>
                <a href="{{ route('live-auction') }}" class="eg-btn btn--primary btn--md">Purchase Item</a>
             </div>
          </div>
          <div class="col-xl-6 col-lg-6 d-flex justify-content-lg-end justify-content-center">
             <div class="how-work-img wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".2s"
                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                <img alt="image" src="assets/images/bg/how-work3.png" class="work-img">
             </div>
          </div>
       </div>
    </div>
 </div>
 
@include('layouts.why-choose-us')

<x-metric-card />

@endsection
