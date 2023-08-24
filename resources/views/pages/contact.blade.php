@extends('partials.app')
@section('title', 'Contact')
@section('description', 'Contact us for any questions or concerns.')
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Contact'])

<div class="contact-section pt-120 pb-120">
    <div class="container">
        <div class="row pb-120 mb-70 g-4 d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="contact-signle hover-border1 d-flex flex-row align-items-center wow fadeInDown"
                    data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                    <div class="icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="text">
                        <h4>Location</h4>
                        <p>168/170, Ave 01,Old York Drive Rich Mirpur, Dhaka</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="contact-signle hover-border1 d-flex flex-row align-items-center wow fadeInDown"
                    data-wow-duration="1.5s" data-wow-delay=".4s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInDown;">
                    <div class="icon">
                        <i class="bx bx-phone-call"></i>
                    </div>
                    <div class="text">
                        <h4>Phone</h4>
                        <a href="tel:+880171-770000">+02 135498 26649</a>
                        <a href="tel:+8801761111456">+8801761111456</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="contact-signle hover-border1 d-flex flex-row align-items-center wow fadeInDown"
                    data-wow-duration="1.5s" data-wow-delay=".6s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.6s; animation-name: fadeInDown;">
                    <div class="icon">
                        <i class="bx bx-envelope"></i>
                    </div>
                    <div class="text">
                        <h4>Email</h4>
                        <a href="mailto:support@example.com">support@example.com</a>
                        <a href="mailto:info@example.com">info@example.com</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="form-wrapper wow fadeInDown" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                    <div class="form-title2">
                        <h3>Get in Touch</h3>
                        <p class="para">Feel free to ask me any question or let's do to talk about our future
                            collaboration.</p>
                    </div>
                    <form action="#">
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="form-inner">
                                    <input type="text" placeholder="Your Name :">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="form-inner">
                                    <input type="email" placeholder="Your Email :">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="form-inner">
                                    <input type="text" placeholder="Your Phone :">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="form-inner">
                                    <input type="text" placeholder="Subject :">
                                </div>
                            </div>
                            <div class="col-12">
                                <textarea name="message" placeholder="Write Message :" rows="12"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="eg-btn btn--primary btn--md form--btn">Send
                                    Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="map-area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".4s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInUp;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6255252.31904332!2d-106.08810052683293!3d40.04590513383155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sbd!4v1650355365902!5m2!1sen!2sbd"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.metrics')
@endsection