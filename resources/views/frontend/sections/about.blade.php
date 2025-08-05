@extends('layouts.layout')
@section('styles')
<style>

</style>
@endsection
@section('content')

        <!-- page-title -->
        <section class="page-title centred">
            <div class="bg-layer" style="background-image: url({{ asset('frontend/assets/images/background/page-title.jpg') }});"></div>
            <div class="line-box">
                <div class="line-1"></div>
                <div class="line-2"></div>
            </div>
            <div class="auto-container">
                <div class="content-box">
                    <h1>About Company</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="#">Home</a></li>
                        <li>About</li>
                        <li>Company</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- page-title end -->


        <!-- about-style-two -->
        <section class="about-style-two">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image-box">
                            <figure class="image image-1"><img src="{{ asset('frontend/assets/images/resource/about-2.jpg') }}" alt=""></figure>
                            <figure class="image image-2"><img src="{{ asset('frontend/assets/images/resource/about-3.jpg') }}" alt=""></figure>
                            <div class="text-box">
                                <h5>Years Experienced</h5>
                                <h2>12+</h2>
                            </div>
                            <div class="icon-box"><i class="flaticon-factory"></i></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="slider-content sec-pad">
                            <div class="about-carousel owl-carousel owl-theme owl-dots-none">
                                <div class="content-box">
                                    <div class="sec-title">
                                        <span class="sub-title">About Company</span>
                                        <h2>Most Favorite Company for Metal Fabrication</h2>
                                    </div>
                                    <ul class="list-item clearfix">
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis omnis non laborum at vel dolores officia obcaecati iure provident architecto.</p>
                                    </ul>
                                    <div class="text">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, quibusdam optio eius numquam corporis temporibus illo nesciunt omnis hic officiis error, dolorem reprehenderit fugiat delectus commodi earum fugit veritatis quos odio! Unde adipisci repellendus quisquam atque ratione, quas quasi harum. Rem voluptatum maiores molestiae. Laboriosam quo doloribus reprehenderit magni totam.</p>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-style-two end -->


        <!-- statements-section -->
        <section class="statements-section sec-pad bg-color-1 border-top border-bottom">
            <div class="auto-container">
                <div class="sec-title centred">
                    <span class="sub-title">Statements</span>
                    <h2>Committed to Value & You</h2>
                </div>
                <div class="tabs-box">
                    <div class="tab-btn-box centred">
                        <ul class="tab-btns tab-buttons clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">
                                <div class="icon-box"><i class="flaticon-target-1"></i></div>
                                <h4>Mission Statement</h4>
                            </li>
                            <li class="tab-btn" data-tab="#tab-2">
                                <div class="icon-box"><i class="flaticon-vision"></i></div>
                                <h4>Vision Statement</h4>
                            </li>
                            <li class="tab-btn" data-tab="#tab-3">
                                <div class="icon-box"><i class="flaticon-diamond"></i></div>
                                <h4>Value Statement</h4>
                            </li>
                            <li class="tab-btn" data-tab="#tab-4">
                                <div class="icon-box"><i class="flaticon-settings"></i></div>
                                <h4>Innovation</h4>
                            </li>
                        </ul>
                    </div>
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="content-box">
                                <div class="bg-layer" style="background-image: url({{ asset('frontend/assets/images/resource/tab-1.jpg') }});"></div>
                                <span class="big-text">Statements</span>
                                <div class="inner-box">
                                    <h2>To Exceed Customers Expectations in Quality Delivery & Cost.</h2>
                                    <p>To take a trivial example, which of us ever undertakes  that laborious physical exercise, except to obtain find some off advantage from it? But who has any right to find fault  how with a man who chooses to enjoy a pleasure that has no annoying consequences.</p>
                                    {{-- <a href="#" class="theme-btn btn-two"><span>More Details</span></a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="content-box">
                                <div class="bg-layer" style="background-image: url({{ asset('frontend/assets/images/resource/tab-1.jpg') }});"></div>
                                <span class="big-text">Statements</span>
                                <div class="inner-box">
                                    <h2>To Exceed Customers Expectations in Quality Delivery & Cost.</h2>
                                    <p>To take a trivial example, which of us ever undertakes  that laborious physical exercise, except to obtain find some off advantage from it? But who has any right to find fault  how with a man who chooses to enjoy a pleasure that has no annoying consequences.</p>
                                    {{-- <a href="#" class="theme-btn btn-two"><span>More Details</span></a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-3">
                            <div class="content-box">
                                <div class="bg-layer" style="background-image: url({{ asset('frontend/assets/images/resource/tab-1.jpg') }});"></div>
                                <span class="big-text">Statements</span>
                                <div class="inner-box">
                                    <h2>To Exceed Customers Expectations in Quality Delivery & Cost.</h2>
                                    <p>To take a trivial example, which of us ever undertakes  that laborious physical exercise, except to obtain find some off advantage from it? But who has any right to find fault  how with a man who chooses to enjoy a pleasure that has no annoying consequences.</p>
                                    {{-- <a href="#" class="theme-btn btn-two"><span>More Details</span></a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-4">
                            <div class="content-box">
                                <div class="bg-layer" style="background-image: url({{ asset('frontend/assets/images/resource/tab-1.jpg') }});"></div>
                                <span class="big-text">Innovation</span>
                                <div class="inner-box">
                                    <h2>To Exceed Customers Expectations in Quality Delivery & Cost.</h2>
                                    <p>To take a trivial example, which of us ever undertakes  that laborious physical exercise, except to obtain find some off advantage from it? But who has any right to find fault  how with a man who chooses to enjoy a pleasure that has no annoying consequences.</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- statements-section end -->


        <!-- funfact-section -->
        <section class="funfact-section" style="text-align: center; display: flex; align-items: center; justify-content: center; min-height: 100vh;">
            <span class="big-text">Numbers</span>
            <div class="outer-container" style="width: 100%; max-width: 1200px; margin: 0 auto;">
                <div class="row clearfix" style="justify-content: center;">
                    <div class="col-lg-4 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="flaticon-factory"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="45">0</span>
                                </div>
                                <div class="text">
                                    <h3>Branches</h3>
                                    <p>Branches Across The World</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="flaticon-gas"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="32">0</span><span>k</span>
                                </div>
                                <div class="text">
                                    <h3>Projects</h3>
                                    <p>Projects with 100% Satisfaction</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="flaticon-engineer"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="867">0</span>
                                </div>
                                <div class="text">
                                    <h3>Engineers</h3>
                                    <p>Top Engineers around the World</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="fa-solid fa-user"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="1250">0</span><span>+</span>
                                </div>
                                <div class="text">
                                    <h3>Happy Clients</h3>
                                    <p>Satisfied Customers Worldwide</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="fa-solid fa-clock"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="25">0</span>
                                </div>
                                <div class="text">
                                    <h3>Years Experience</h3>
                                    <p>Decades of Excellence</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one">
                            <div class="inner-box">
                                <div class="icon-box"><i class="fa-solid fa-award"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="98">0</span><span>%</span>
                                </div>
                                <div class="text">
                                    <h3>Quality Rate</h3>
                                    <p>Quality Assurance Excellence</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- funfact-section end -->



      


        <!-- chooseus-style-two -->
        <section class="chooseus-style-two bg-color-1 border-top border-bottom">
            <div class="outer-container clearfix">
                <div class="chooseus-block-one">
                    <div class="inner-box">
                        <div class="icon-box"><i class="flaticon-manufacture"></i></div>
                        <h3><a href="#"><i class="flaticon-right-chevron"></i>Smart Technology</a></h3>
                        <p>Lookout flogging bilge rat main shet bilge water fluke to go on account heave down.</p>
                    </div>
                </div>
                <div class="chooseus-block-one">
                    <div class="inner-box">
                        <div class="icon-box"><i class="flaticon-target"></i></div>
                        <h3><a href="#"><i class="flaticon-right-chevron"></i>On-Time Delivery</a></h3>
                        <p>Duty or the obligations of business will frequently occur that have to be repudiated annoyances.</p>
                    </div>
                </div>
                <div class="chooseus-block-one">
                    <div class="inner-box">
                        <div class="icon-box"><i class="flaticon-agreement"></i></div>
                        <h3><a href="#"><i class="flaticon-right-chevron"></i>Easy & Affordable</a></h3>
                        <p>Holds in these matters to this princi- ple of selection we rejects to secure other greater endures.</p>
                    </div>
                </div>
                <div class="chooseus-block-one">
                    <div class="inner-box">
                        <div class="icon-box"><i class="flaticon-call-center"></i></div>
                        <h3><a href="#"><i class="flaticon-right-chevron"></i>24/7 Support</a></h3>
                        <p>Lookout flogging bilge rat main shet bilge water fluke to go on account heave down.</p>
                    </div>
                </div>
                <div class="chooseus-block-one">
                    <div class="inner-box">
                        <div class="icon-box"><i class="flaticon-engineer"></i></div>
                        <h3><a href="#"><i class="flaticon-right-chevron"></i>Professional Team</a></h3>
                        <p>Duty or the obligations of business will frequently occur that have to be repudiated annoyances.</p>
                    </div>
                </div>
                
                
            </div>
        </section>
        <!-- chooseus-style-two end -->


        
@endsection