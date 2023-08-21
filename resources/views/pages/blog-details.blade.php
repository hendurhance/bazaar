@extends('partials.app')
@section('title', 'Blog')
@section('description', 'Read our blog posts to learn more about us and our platform.')
@section('content')

<div class="inner-banner">
    <div class="container">
        <h2 class="inner-banner-title wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".2s"
            style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInLeft;">
            Blog Details</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
            </ol>
        </nav>
    </div>
</div>

<div class="blog-details-section pt-120 pb-120">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-8">
                <div class="blog-details-single">
                    <div class="blog-img">
                        <img alt="image" src="assets/images/blog/blog-details.png" class="img-fluid wow fadeInDown"
                            data-wow-duration="1.5s" data-wow-delay=".2s"
                            style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInDown;">
                    </div>
                    <ul class="blog-meta gap-2">
                        <li><a href="#"><img alt="image" src="assets/images/icons/calendar.svg">Date: 25 Jan 2022</a>
                        </li>
                        <li><a href="#"><img alt="image" src="assets/images/icons/tags.svg">Auction</a></li>
                        <li><a href="#"><img alt="image" src="assets/images/icons/admin.svg">Posted by Admin</a></li>
                    </ul>
                    <h3 class="blog-title">A brand for a company is like reputation for a person.</h3>
                    <div class="blog-content">
                        <p class="para">Gochujang ugh viral, butcher pabst put a bird on it meditation austin craft beer
                            banh. Distillery ramps af, goch ujang hell of VHS kitsch austin. Vegan air plant trust fund,
                            poke sartorial ennui next lev el photo booth coloring book etsy green juice meditation
                            austin craft beer.</p>
                        <blockquote>
                            <img alt="image" src="assets/images/icons/quote-fill.svg" class="quote-icon">
                            <p class="para">“If the delivery provider maintains all the standards then it is safe to
                                have get products delivered to you. It is hard to maintain but still safer to get your
                                products ordered If you’ve been following the crypto space”</p>
                            <h5>-- Leslie Alexander</h5>
                        </blockquote>
                        <h4 class="sub-title">How can have anything you ant in life if you ?</h4>
                        <p class="para">If you’ve been following the crypto space, you’ve likely heard of Non-Fungible
                            Tokens (Biddings), more popularly referred to as ‘Crypto Collectibles.’ The world of
                            Biddings is growing rapidly. It seems there is no slowing down of these assets as they
                            continue to go up in price. This growth comes with the opportunity for people to start new
                            businesses to create and capture value. The market is open for players in every kind of
                            field. Are you a collector.</p>
                        <div class="blog-video-area">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <img alt="image" src="assets/images/blog/blogd1.png" class="img-fluid">
                                </div>
                                <div class="col-md-6">
                                    <div class="video-wrapper position-relative">
                                        <div class="video-play">
                                            <a href="https://www.youtube.com/watch?v=u31qwQUeGuM"
                                                class="popup-youtube video-icon" savefrom_lm_index="0"
                                                savefrom_lm="1"><i class="bx bx-play"></i></a><span
                                                style="padding: 0; margin: 0; margin-left: 5px;"><a
                                                    href="http://savefrom.net/?url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3Du31qwQUeGuM&amp;utm_source=chameleon&amp;utm_medium=extensions&amp;utm_campaign=link_modifier"
                                                    target="_blank" title="Get a direct link" savefrom_lm="1"
                                                    savefrom_lm_is_link="1"
                                                    style="background-image: url(&quot;data:image/gif;base64,R0lGODlhEAAQAOZ3APf39+Xl5fT09OPj4/Hx8evr6/3+/u7u7uDh4OPi497e3t7e3/z8/P79/X3GbuXl5ubl5eHg4WzFUfb39+Pj4lzGOV7LOPz7+/n6+vn5+ZTLj9/e387Ozt7f3/7+/vv7/ISbePn5+m/JV1nRKXmVbkCnKVrSLDqsCuDh4d/e3uDn3/z7/H6TdVeaV1uSW+bn5v39/eXm5eXm5kyHP/f39pzGmVy7J3yRd9/f3mLEKkXCHJbka2TVM5vaZn6Wdfn6+YG/c/r5+ZO/jeLi41aHTIeageLn4f39/vr6+kzNG2PVM5i+lomdf2CXYKHVmtzo2YXNeDqsBebl5uHh4HDKWN3g3kKqEH6WeZHTXIPKdnSPbv79/pfmbE7PHpe1l4O8dTO5DODg4VDLIlKUUtzo2J7SmEWsLlG4NJbFjkrJHP7+/VK5Nfz8+zmnC3KKa+Hg4OHh4Y63j/3+/eDg4Ojo6P///8DAwP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAHcALAAAAAAQABAAAAfWgHd2g4SFhYJzdYqLjIpzgx5bBgYwHg1Hk2oNDXKDFwwfDF5NLmMtcStsn4MhGT8YS04aGmU1QRhIGYMTADQAQlAODlloAMYTgwICRmRfVBISIkBPKsqDBAREZmcVFhYVayUz2IMHB1dWOmImI2lgUVrmgwUFLzdtXTxKSSduMfSD6Aik48MGlx05SAykM0gKhAAPAhTB0oNFABkPHg5KMIBCxzlMQFQZMGBIggSDpsCJgGDOmzkIUCAIM2dOhEEcNijQuQDHgg4KOqRYwMGOIENIB90JBAA7&quot;); background-repeat: no-repeat; width: 16px; height: 16px; display: inline-block; border: none; text-decoration: none; padding: 0px; position: relative;"></a></span>
                                        </div>
                                        <img alt="image" src="assets/images/blog/blogd2.png" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="para">Gochujang ugh viral, butcher pabst put a bird on it meditation austin craft beer
                            banh. Distillery ramps af, goch ujang hell of VHS kitsch austin. Vegan air plant trust fund,
                            poke sartorial ennui next lev el photo booth coloring book etsy green juice meditation
                            austin craft beer.</p>
                    </div>
                    <div class="blog-tag">
                        <div class="row g-3">
                            <div
                                class="col-md-6 d-flex justify-content-md-start justify-content-center align-items-center">
                                <h6>Post Tag:</h6>
                                <ul class="tag-list">
                                    <li><a href="#">Network Setup</a></li>
                                    <li><a href="#">Cars</a></li>
                                    <li><a href="#">Technology</a></li>
                                </ul>
                            </div>
                            <div
                                class="col-md-6 d-flex justify-content-md-end justify-content-center align-items-center">
                                <ul class="share-social gap-3">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest-alt"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="blog-author gap-4 flex-md-nowrap flex-wrap">
                        <div class="author-image">
                            <img alt="image" src="assets/images/blog/blog-author.png" class="img-fluid">
                        </div>
                        <div class="author-detials text-md-start text-center">
                            <h5>-- Leslie Alexander</h5>
                            <p class="para">It has survived not only five centuries, but also the leap into electronic
                                typesetting unchanged. It was popularised in the sheets containing lorem ipsum is simply
                                free text.</p>
                        </div>
                    </div>
                    <div class="blog-comment">
                        <div class="blog-widget-title">
                            <h4>Comments (03)</h4>
                            <span></span>
                        </div>
                        <ul class="comment-list mb-50">
                            <li>
                                <div class="comment-box">
                                    <div class="comment-header d-flex justify-content-between align-items-center">
                                        <div class="author d-flex flex-wrap">
                                            <img alt="image" src="assets/images/blog/comment1.png">
                                            <h5><a href="#">Leslie Waston</a></h5><span class="commnt-date"> April 6,
                                                2022 at 3:54 am</span>
                                        </div>
                                        <a href="#" class="commnt-reply"><i class="bi bi-reply"></i></a>
                                    </div>
                                    <div class="comment-body">
                                        <p class="para">Aenean dolor massa, rhoncus ut tortor in, pretium tempus neque.
                                            Vestibulum venenati leo et dic tum finibus. Nulla vulputate dolor sit amet
                                            tristique dapibus.Gochujang ugh viral, butcher pabst put a bird on it
                                            meditation austin.</p>
                                    </div>
                                </div>
                                <ul class="comment-reply">
                                    <li>
                                        <div class="comment-box">
                                            <div
                                                class="comment-header d-flex justify-content-between align-items-center">
                                                <div class="author d-flex flex-wrap">
                                                    <img alt="image" src="assets/images/blog/comment2.png">
                                                    <h5><a href="#">Robert Fox</a></h5><span class="commnt-date"> April
                                                        6, 2022 at 3:54 am</span>
                                                </div>
                                                <a href="#" class="commnt-reply"><i class="bi bi-reply"></i></a>
                                            </div>
                                            <div class="comment-body">
                                                <p class="para">Aenean dolor massa, rhoncus ut tortor in, pretium tempus
                                                    neque. Vestibulum venenati leo et dic tum finibus. Nulla vulputate
                                                    dolor sit amet tristique dapibus.Gochujang ugh viral, butcher pabst
                                                    put a bird on it meditation austin.</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="comment-box">
                                    <div class="comment-header d-flex justify-content-between align-items-center">
                                        <div class="author d-flex flex-wrap">
                                            <img alt="image" src="assets/images/blog/comment3.png">
                                            <h5><a href="#">William Harvey</a></h5><span class="commnt-date"> April 6,
                                                2022 at 3:54 am</span>
                                        </div>
                                        <a href="#" class="commnt-reply"><i class="bi bi-reply"></i></a>
                                    </div>
                                    <div class="comment-body">
                                        <p class="para">Aenean dolor massa, rhoncus ut tortor in, pretium tempus neque.
                                            Vestibulum venenati leo et dic tum finibus. Nulla vulputate dolor sit amet
                                            tristique dapibus.Gochujang ugh viral, butcher pabst put a bird on it
                                            meditation austin.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="comment-form">
                        <div class="blog-widget-title style2">
                            <h4>Leave A Comment</h4>
                            <p class="para">Your email address will not be published.</p>
                            <span></span>
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
                                <div class="col-12">
                                    <div class="form-inner">
                                        <textarea name="message" placeholder="Write Message :" rows="12"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="eg-btn btn--primary btn--md form--btn">Submit
                                        Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <div class="blog-sidebar">
                    <div class="blog-widget-item wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <div class="search-area">
                            <div class="sidebar-widget-title">
                                <h4>Search From Blog</h4>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <form>
                                    <div class="form-inner">
                                        <input type="text" placeholder="Search Here">
                                        <button class="search--btn"><i class="bx bx-search-alt-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="blog-widget-item wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".4s"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <div class="blog-category">
                            <div class="sidebar-widget-title">
                                <h4>Recent Post</h4>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="recent-post">
                                    <li class="single-post">
                                        <div class="post-img">
                                            <a href="blog-details.html"><img alt="image"
                                                    src="assets/images/blog/recent-feed1.png"></a>
                                        </div>
                                        <div class="post-content">
                                            <span>January 31, 2022</span>
                                            <h6><a href="blog-details.html">Grant Distributions Conti nu to Incr
                                                    Ease.</a>
                                            </h6>
                                        </div>
                                    </li>
                                    <li class="single-post">
                                        <div class="post-img">
                                            <a href="blog-details.html"><img alt="image"
                                                    src="assets/images/blog/recent-feed2.png"></a>
                                        </div>
                                        <div class="post-content">
                                            <span>February 21, 2022</span>
                                            <h6><a href="blog-details.html">Seminar for Children to Learn About.</a>
                                            </h6>
                                        </div>
                                    </li>
                                    <li class="single-post">
                                        <div class="post-img">
                                            <a href="blog-details.html"><img alt="image"
                                                    src="assets/images/blog/recent-feed3.png"></a>
                                        </div>
                                        <div class="post-content">
                                            <span>March 22, 2022</span>
                                            <h6><a href="blog-details.html">Education and teacher for all African
                                                    Children.</a></h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="blog-widget-item wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".4s"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <div class="top-blog">
                            <div class="sidebar-widget-title">
                                <h4>Post Categories</h4>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="category-list">
                                    <li><a href="#"><span>New Technology</span><span>01</span></a></li>
                                    <li><a href="#"><span>Network Setup</span><span>12</span></a></li>
                                    <li><a href="#"><span>Audi Car Bidding </span><span>33</span></a></li>
                                    <li><a href="#"><span>Entertainment</span><span>54</span></a></li>
                                    <li><a href="#"><span>New Technology</span><span>24</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="blog-widget-item wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".8s"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.8s; animation-name: fadeInUp;">
                        <div class="tag-area">
                            <div class="sidebar-widget-title">
                                <h4>Follow Social</h4>
                                <span></span>
                            </div>
                            <div class="blog-widget-body">
                                <ul class="sidebar-social-list gap-4">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest-alt"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-banner wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s"
                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 1s; animation-name: fadeInUp;">
                        <div class="banner-content">
                            <span>CARS</span>
                            <h3>Toyota AIGID A Clasis Cars Sale</h3>
                            <a href="auction-details.html" class="eg-btn btn--primary card--btn">Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.metrics')

@endsection