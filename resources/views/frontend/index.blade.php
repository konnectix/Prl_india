@extends('layouts.layout')
@section('styles')
<style>

</style>
@endsection
@section('content')

        <!-- banner-section -->
        <section class="banner-section">
            <div class="line-box">
                <div class="line-1"></div>
                <div class="line-2"></div>
            </div>
            <div class="banner-carousel owl-theme owl-carousel">
                <div class="slide-item">
                    <div class="image-layer">
                        <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1;">
                            <source src="{{asset('frontend/assets/videos/background-video.mp4')}}" type="video/mp4">
                            <!-- Fallback background image if video doesn't load -->
                            <div style="background-image:url({{asset('frontend/assets/images/banner/banner-1.jpg')}}); width: 100%; height: 100%; position: absolute; top: 0; left: 0; z-index: -1;"></div>
                        </video>
                    </div>
                    <div class="auto-container">
                        <div class="content-box">
                            <span class="special-text animation_text_word"></span>
                            <h2><span>Build a Stronger</span> <br /><span>Product...</span></h2>
                            <p>Favor the more eloquent presidential days of yesteryear give ipsum a whirl & <br />get some engaging every pleasure is to be welcomed.</p>
                            <div class="btn-box">
                                <a href="#" class="theme-btn btn-one"><span>More Details</span></a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            {{-- <div class="text-box">
                <div class="text-1"><h3>Casting and Molding</h3></div>
                <div class="text-2"><h3>Shearing and Forming</h3></div>
            </div> --}}
        </section>
        <!-- banner-section end -->


        <!-- about-section -->
        <section class="about-section">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image-box">
                            <figure class="image"><img src="{{asset('frontend/assets/images/resource/about-1.jpg')}}" alt=""></figure>
                            <div class="text">
                                <h5>12+ Years Experienced</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content-box">
                            <div class="sec-title">
                                <span class="sub-title">About Us</span>
                                <h2>A Company of Excellent Services</h2>
                            </div>
                            <div class="text">
                                <p>Righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, trouble that are bound to ensue.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
                            </div>
                            
                            <div class="btn-box">
                                <a href="#" class="theme-btn btn-one" style="background-color: #e4492e; color: #fff; "><span>More Details</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-section end -->


        <!-- funfact-section -->
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
        <!-- funfact-section end -->



        <!-- clients-section -->
        <section class="clients-section bg-color-1">
            <div class="auto-container">
                <div class="five-item-carousel owl-carousel owl-theme owl-nav-none owl-dots-none">
                    <figure class="clients-logo"><a href="#"><img src="{{asset('frontend/assets/images/clients/clients-1.png')}}" alt=""></a></figure>
                    <figure class="clients-logo"><a href="#"><img src="{{asset('frontend/assets/images/clients/clients-2.png')}}" alt=""></a></figure>
                    <figure class="clients-logo"><a href="#"><img src="{{asset('frontend/assets/images/clients/clients-3.png')}}" alt=""></a></figure>
                    <figure class="clients-logo"><a href="#"><img src="{{asset('frontend/assets/images/clients/clients-4.png')}}" alt=""></a></figure>
                    <figure class="clients-logo"><a href="#"><img src="{{asset('frontend/assets/images/clients/clients-5.png')}}" alt=""></a></figure>
                </div>
            </div>
        </section>
        <!-- clients-section end -->


        <!-- chooseus-section -->
        <section class="chooseus-section">
            <div class="pattern-layer" style="background-image: url({{asset('frontend/assets/images/shape/shape-4.png')}});"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-xl-6 col-lg-12 col-md-12 title-column">
                        <div class="sec-title">
                            <span class="sub-title">Why Choose Us</span>
                            <h2>Deliver On Time and On Budget</h2>
                            <p>Onethose defining moments a moment when our nation is at war our economy turmoil.</p>
                            <a href="{{ route('frontend.about') }}" class="theme-btn btn-two"><span>More Details</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-column">
                <div class="scroll-text">
                    <ul class="text-list clearfix"> 
                        <li>deliver on time & on budget</li>
                        <li>A dedicated service</li>
                    </ul>
                </div>
                <div class="content-box">
                    <div class="single-item">
                        <div class="static-content">
                            <span class="count-text">01</span>
                            <div class="text">
                                <h3>Smart Technology</h3>
                                <p>Lookout flogging bilge rat main shet bilge water fluke to go on account heave down.</p>
                            </div>
                        </div>
                        <div class="overlay-content">
                            <div class="icon-box"><i class="flaticon-manufacture"></i></div>
                            <div class="text">
                                <h3>Smart Technology</h3>
                                <p>Lookout flogging bilge rat main shet bilge water fluke to go on account heave down.</p>
                            </div>
                        </div>
                    </div>
                    <div class="single-item">
                        <div class="static-content">
                            <span class="count-text">02</span>
                            <div class="text">
                                <h3>On-Time Delivery</h3>
                                <p>Get swash buckling with this trendy looking</p>
                            </div>
                        </div>
                        <div class="overlay-content">
                            <div class="icon-box"><i class="flaticon-manufacture"></i></div>
                            <div class="text">
                                <h3>On-Time Delivery</h3>
                                <p>Get swash buckling with this trendy looking</p>
                            </div>
                        </div>
                    </div>
                    <div class="single-item">
                        <div class="static-content">
                            <span class="count-text">03</span>
                            <div class="text">
                                <h3>Easy & Affordable</h3>
                                <p>Sheet bilge water nipper fluke to go on account </p>
                            </div>
                        </div>
                        <div class="overlay-content">
                            <div class="icon-box"><i class="flaticon-manufacture"></i></div>
                            <div class="text">
                                <h3>Easy & Affordable</h3>
                                <p>Sheet bilge water nipper fluke to go on account </p>
                            </div>
                        </div>
                    </div>
                    <div class="single-item">
                        <div class="static-content">
                            <span class="count-text">04</span>
                            <div class="text">
                                <h3>24/7 Support</h3>
                                <p>Coast schooner poop deck main sheet</p>
                            </div>
                        </div>
                        <div class="overlay-content">
                            <div class="icon-box"><i class="flaticon-manufacture"></i></div>
                            <div class="text">
                                <h3>24/7 Support</h3>
                                <p>Coast schooner poop deck main sheet</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="scroll-text">
                    <ul class="text-list clearfix"> 
                        <li>deliver on time & on budget</li>
                        <li>A dedicated service</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- chooseus-section end -->

        <h2 style="text-align:center; margin: 40px 0 20px 0; font-weight: bold;">Technology</h2>
        <!-- industry-section -->
        <section class="industry-section">
            <div class="industry-tab">
                <div class="tab-btns industry-tab-btns centred border-top border-bottom">
                    <div class="auto-container">
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-6 col-sm-12 single-btn">
                                <div class="p-tab-btn active-btn" data-tab="#tab-1">
                                    <div class="icon-box"><i class="flaticon-crane"></i></div>
                                    <h4>Construction Sector</h4>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 single-btn">
                                <div class="p-tab-btn" data-tab="#tab-2">
                                    <div class="icon-box"><i class="flaticon-tanks"></i></div>
                                    <h4>Oil & Gas Energy</h4>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 single-btn">
                                <div class="p-tab-btn" data-tab="#tab-3">
                                    <div class="icon-box"><i class="flaticon-vaccine"></i></div>
                                    <h4>Heath Care & Pharma</h4>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 single-btn">
                                <div class="p-tab-btn" data-tab="#tab-4">
                                    <div class="icon-box"><i class="flaticon-radiator"></i></div>
                                    <h4>Automotive Chains</h4>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="auto-container">
                    <div class="p-tabs-content">
                        <div class="p-tab active-tab" id="tab-1">
                            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                                <div class="content-inner">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                                            <div class="content-box">
                                                <div class="sec-title">
                                                    <span class="sub-title">Industry</span>
                                                    <h2>Construction Sector</h2>
                                                </div>
                                                <div class="inner-box">
                                                    <ul class="list-style-one clearfix">
                                                        <li>Mechanized Bridge Construction</li>
                                                        <li>Movable Scaffolding Systems</li>
                                                    </ul>
                                                    <p>Lookout flogging bilge rat main shet bilge water nipper fluke to go on account heave down clap of thunder. Reef sails six pounders skysail code off conduct.</p>
                                                    {{--  --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{asset('frontend/assets/images/resource/industry-2.jpg')}}" alt="" style="max-width: 300px; height: auto; margin: 0 auto; display: block;"></figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="p-tab" id="tab-2">
                            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                                <div class="content-inner">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                                            <div class="content-box">
                                                <div class="sec-title">
                                                    <span class="sub-title">Industry</span>
                                                    <h2>Oil & Gas Energy</h2>
                                                </div>
                                                <div class="inner-box">
                                                    <ul class="list-style-one clearfix">
                                                        <li>Mechanized Bridge Construction</li>
                                                        <li>Movable Scaffolding Systems</li>
                                                    </ul>
                                                    <p>Lookout flogging bilge rat main shet bilge water nipper fluke to go on account heave down clap of thunder. Reef sails six pounders skysail code off conduct.</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{ asset('frontend/assets/images/resource/industry-2.jpg') }}" alt="" style="max-width: 300px; height: auto; margin: 0 auto; display: block;"></figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                        <div class="p-tab" id="tab-3">
                            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                                <div class="content-inner">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                                            <div class="content-box">
                                                <div class="sec-title">
                                                    <span class="sub-title">Industry</span>
                                                    <h2>Heath Care & Pharma</h2>
                                                </div>
                                                <div class="inner-box">
                                                    <ul class="list-style-one clearfix">
                                                        <li>Mechanized Bridge Construction</li>
                                                        <li>Movable Scaffolding Systems</li>
                                                    </ul>
                                                    <p>Lookout flogging bilge rat main shet bilge water nipper fluke to go on account heave down clap of thunder. Reef sails six pounders skysail code off conduct.</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{ asset('frontend/assets/images/resource/industry-2.jpg') }}" alt="" style="max-width: 300px; height: auto; margin: 0 auto; display: block;"></figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                        <div class="p-tab" id="tab-4">
                            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                                <div class="content-inner">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                                            <div class="content-box">
                                                <div class="sec-title">
                                                    <span class="sub-title">Industry</span>
                                                    <h2>Automotive Chains</h2>
                                                </div>
                                                <div class="inner-box">
                                                    <ul class="list-style-one clearfix">
                                                        <li>Mechanized Bridge Construction</li>
                                                        <li>Movable Scaffolding Systems</li>
                                                    </ul>
                                                    <p>Lookout flogging bilge rat main shet bilge water nipper fluke to go on account heave down clap of thunder. Reef sails six pounders skysail code off conduct.</p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{ asset('frontend/assets/images/resource/industry-2.jpg') }}" alt="" style="max-width: 300px; height: auto; margin: 0 auto; display: block;"></figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- industry-section end -->





        <!-- working-section -->
        <section class="working-section bg-color-1">
            <div class="auto-container">
                <div class="sec-title centred">
                    <span class="sub-title">Sectors We Serve</span>
                    <h2>Lorem Ipsun</h2>
                </div>
            </div>
            <div class="outer-container border-top border-bottom">
                <div class="bg-layer" style="background-image: url({{asset('frontend/assets/images/background/working-bg.jpg')}});"></div>
                <div class="auto-container">
                    <div class="tabs-box">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                                <div class="tabs-content">
                                    <div class="tab active-tab" id="tab-5">
                                        <div class="content-box">
                                            <span> 01</span>
                                            <h3>Request Quotation</h3>
                                            <p>Bilge rat main shet bilge water nipper fluketo go on account heave down clap of thunder. Reef sails six pounders skysail code off conduct.</p>
                                            {{-- <div class="btn-box">
                                                <a href="#"><span>Request Your Quote</span></a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="tab" id="tab-6">
                                        <div class="content-box">
                                            <span> 02</span>
                                            <h3>Planning Stage</h3>
                                            <p>Bilge rat main shet bilge water nipper fluketo go on account heave down clap of thunder. Reef sails six pounders skysail code off conduct.</p>
                                            {{-- <div class="btn-box">
                                                <a href="#"><span>Request Your Quote</span></a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="tab" id="tab-7">
                                        <div class="content-box">
                                            <span> 03</span>
                                            <h3>Product Development</h3>
                                            <p>Bilge rat main shet bilge water nipper fluketo go on account heave down clap of thunder. Reef sails six pounders skysail code off conduct.</p>
                                            {{-- <div class="btn-box">
                                                <a href="#"><span>Request Your Quote</span></a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="tab" id="tab-8">
                                        <div class="content-box">
                                            <span> 04</span>
                                            <h3>Production / Evaluation</h3>
                                            <p>Bilge rat main shet bilge water nipper fluketo go on account heave down clap of thunder. Reef sails six pounders skysail code off conduct.</p>
                                            {{-- <div class="btn-box">
                                                <a href="#"><span>Request Your Quote</span></a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="tab" id="tab-9">
                                        <div class="content-box">
                                            <span> 05</span>
                                            <h3>Inspection & Delivery</h3>
                                            <p>Bilge rat main shet bilge water nipper fluketo go on account heave down clap of thunder. Reef sails six pounders skysail code off conduct.</p>
                                            {{-- <div class="btn-box">
                                                <a href="#"><span>Request Your Quote</span></a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="tab" id="tab-10">
                                        <div class="content-box">
                                            <span> 06</span>
                                            <h3>Inspection & Delivery</h3>
                                            <p>Bilge rat main shet bilge water nipper fluketo go on account heave down clap of thunder. Reef sails six pounders skysail code off conduct.</p>
                                            {{-- <div class="btn-box">
                                                <a href="#"><span>Request Your Quote</span></a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="tab" id="tab-11">
                                        <div class="content-box">
                                            <span> 07</span>
                                            <h3>Inspection & Delivery</h3>
                                            <p>Bilge rat main shet bilge water nipper fluketo go on account heave down clap of thunder. Reef sails six pounders skysail code off conduct.</p>
                                            {{-- <div class="btn-box">
                                                <a href="#"><span>Request Your Quote</span></a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="tab" id="tab-12">
                                        <div class="content-box">
                                            <span> 08</span>
                                            <h3>Inspection & Delivery</h3>
                                            <p>Bilge rat main shet bilge water nipper fluketo go on account heave down clap of thunder. Reef sails six pounders skysail code off conduct.</p>
                                                        {{-- <div class="btn-box">
                                                            <a href="#"><span>Request Your Quote</span></a>
                                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 btn-column">
                                <div class="tab-btn-box">
                                    <ul class="tab-btns tab-buttons clearfix" style="display: flex; flex-wrap: wrap;">
                                        <li class="tab-btn active-btn" data-tab="#tab-5" style="width: 12.5%; text-align: center;">
                                            <span>01</span>
                                            <h4>Request&nbsp;Quotation</h4>
                                        </li>
                                        <li class="tab-btn" data-tab="#tab-6" style="width: 12.5%; text-align: center;">
                                            <span>02</span>
                                            <h4>Planning&nbsp;Stage</h4>
                                        </li>
                                        <li class="tab-btn" data-tab="#tab-7" style="width: 12.5%; text-align: center;">
                                            <span>03</span>
                                            <h4>Product&nbsp;Development</h4>
                                        </li>
                                        <li class="tab-btn" data-tab="#tab-8" style="width: 12.5%; text-align: center;">
                                            <span>04</span>
                                            <h4>Production&nbsp;/&nbsp;Evaluation</h4>
                                        </li>
                                        <li class="tab-btn" data-tab="#tab-9" style="width: 12.5%; text-align: center;">
                                            <span>05</span>
                                            <h4>Inspection&nbsp;&&nbsp;Delivery</h4>
                                        </li>
                                        <li class="tab-btn" data-tab="#tab-10" style="width: 12.5%; text-align: center;">
                                            <span>06</span>
                                            <h4>Packaging</h4>
                                        </li>
                                        <li class="tab-btn" data-tab="#tab-11" style="width: 12.5%; text-align: center;">
                                            <span>07</span>
                                            <h4>Shipping</h4>
                                        </li>
                                        <li class="tab-btn" data-tab="#tab-12" style="width: 12.5%; text-align: center;">
                                            <span>08</span>
                                            <h4>After Sales</h4>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- working-section end -->


        <!-- case-section -->
        <section class="case-section">
            <div class="auto-container">
                <div class="sec-title">
                    <span class="sub-title">Team Members</span>
                    <h2>Meet Our Team</h2>
                </div>
            </div>
            <div class="outer-container border-top">
                <div class="case-carousel owl-carousel owl-theme">
                    <div class="case-block-one">
                        <div class="inner-box">
                            <div class="upper-content">
                                <h5>Designer</h5>
                            </div>
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('frontend/assets/images/case/case-1.jpg')}}" alt=""></figure>
                                <div class="view-btn"><a href="{{asset('frontend/assets/images/case/case-1.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                            </div>
                            <div class="lower-content centred">
                                <h3><a href="#">John Doe</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="case-block-one">
                        <div class="inner-box">
                            <div class="upper-content">
                                <h5>Engineer</h5>
                            </div>
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('frontend/assets/images/case/case-2.jpg')}}" alt=" "></figure>
                                <div class="view-btn"><a href="{{asset('frontend/assets/images/case/case-2.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                            </div>
                            <div class="lower-content centred">
                                <h3><a href="#">Jane Doe</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="case-block-one">
                        <div class="inner-box">
                            <div class="upper-content">
                                <h5>Manager</h5>
                            </div>
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('frontend/assets/images/case/case-3.jpg')}}" alt=""></figure>
                                <div class="view-btn"><a href="{{asset('frontend/assets/images/case/case-3.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                            </div>
                            <div class="lower-content centred">
                                <h3><a href="#">John Doe</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="case-block-one">
                        <div class="inner-box">
                            <div class="upper-content">
                                <h5>Sales</h5>
                            </div>
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('frontend/assets/images/case/case-4.jpg')}}" alt=""></figure>
                                <div class="view-btn"><a href="{{asset('frontend/assets/images/case/case-4.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                            </div>
                            <div class="lower-content centred">
                                <h3><a href="#">Jane Doe</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="case-block-one">
                        <div class="inner-box">
                            <div class="upper-content">
                                <h5>Supervisor</h5>
                            </div>
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('frontend/assets/images/case/case-1.jpg')}}" alt=""></figure>
                                <div class="view-btn"><a href="{{asset('frontend/assets/images/case/case-1.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                            </div>
                            <div class="lower-content centred">
                                <h3><a href="#">John Doe</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="case-block-one">
                        <div class="inner-box">
                            <div class="upper-content">
                                <h5>Technician</h5>
                            </div>
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('frontend/assets/images/case/case-2.jpg')}}" alt=""></figure>
                                <div class="view-btn"><a href="{{asset('frontend/assets/images/case/case-2.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                            </div>
                            <div class="lower-content centred">
                                <h3><a href="#">Jane Doe</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="case-block-one">
                        <div class="inner-box">
                            <div class="upper-content">
                                <h5>Worker</h5>
                            </div>
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('frontend/assets/images/case/case-3.jpg')}}" alt=""></figure>
                                <div class="view-btn"><a href="{{asset('frontend/assets/images/case/case-3.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                            </div>
                            <div class="lower-content centred">
                                <h3><a href="#">John Doe</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="case-block-one">
                        <div class="inner-box">
                            <div class="upper-content">
                                <h5>Worker</h5>
                            </div>
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('frontend/assets/images/case/case-4.jpg')}}" alt=""></figure>
                                <div class="view-btn"><a href="{{asset('frontend/assets/images/case/case-4.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                            </div>
                            <div class="lower-content centred">
                                <h3><a href="#">Jane Doe</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="case-block-one">
                        <div class="inner-box">
                            <div class="upper-content">
                                <h5>Worker</h5>
                            </div>
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('frontend/assets/images/case/case-1.jpg')}}" alt=""></figure>
                                <div class="view-btn"><a href="{{asset('frontend/assets/images/case/case-1.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                            </div>
                            <div class="lower-content centred">
                                <h3><a href="#">John Doe</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="case-block-one">
                        <div class="inner-box">
                            <div class="upper-content">
                                <h5>Worker</h5>
                            </div>
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('frontend/assets/images/case/case-2.jpg')}}" alt=""></figure>
                                <div class="view-btn"><a href="{{asset('frontend/assets/images/case/case-2.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                            </div>
                            <div class="lower-content centred">
                                <h3><a href="#">Jane Doe</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="case-block-one">
                        <div class="inner-box">
                            <div class="upper-content">
                                <h5>Worker</h5>
                            </div>
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('frontend/assets/images/case/case-3.jpg')}}" alt=""></figure>
                                <div class="view-btn"><a href="{{asset('frontend/assets/images/case/case-3.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                            </div>
                            <div class="lower-content centred">
                                <h3><a href="#">John Doe</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="case-block-one">
                        <div class="inner-box">
                            <div class="upper-content">
                                <h5>Material, Mechanical</h5>
                            </div>
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('frontend/assets/images/case/case-4.jpg')}}" alt=""></figure>
                                <div class="view-btn"><a href="{{asset('frontend/assets/images/case/case-4.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                            </div>
                            <div class="lower-content centred">
                                <h3><a href="#">Steel Springs</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- case-section end -->


        <!-- testimonial-section -->
        <section class="testimonial-section bg-color-1 border-top border-bottom">
            <div class="auto-container">
                <div class="sec-title">
                    <span class="sub-title">Testimonials</span>
                    <h2>People Says About Machino</h2>
                    <a href="mailto:info@machino.com" class="theme-btn btn-two"><span>Email Us</span></a>
                </div>
                <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                    <div class="testimonial-content">
                        <div class="quote-box">
                            <div class="quote"><i class="flaticon-quote"></i></div>
                        </div>
                        <figure class="thumb-box"><img src="{{asset('frontend/assets/images/resource/testimonial-1.jpg')}}" alt=""></figure>
                        <div class="inner-box">
                            <ul class="rating clearfix">
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                            </ul>
                            <p>Media Tech & Machino Manufacturers have been working together for over 10 years. Their staff is knowledgeable & their response time is prompt.</p>
                            <h3>Nathan Felix</h3>
                            <span class="designation">CEO, High Rise Construction</span>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="quote-box">
                            <div class="quote"><i class="flaticon-quote"></i></div>
                        </div>
                        <figure class="thumb-box"><img src="{{asset('frontend/assets/images/resource/testimonial-1.jpg')}}" alt=""></figure>
                        <div class="inner-box">
                            <ul class="rating clearfix">
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                            </ul>
                            <p>Media Tech & Machino Manufacturers have been working together for over 10 years. Their staff is knowledgeable & their response time is prompt.</p>
                            <h3>Nathan Felix</h3>
                            <span class="designation">CEO, High Rise Construction</span>
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <div class="quote-box">
                            <div class="quote"><i class="flaticon-quote"></i></div>
                        </div>
                        <figure class="thumb-box"><img src="{{asset('frontend/assets/images/resource/testimonial-1.jpg')}}" alt=""></figure>
                        <div class="inner-box">
                            <ul class="rating clearfix">
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                            </ul>
                            <p>Media Tech & Machino Manufacturers have been working together for over 10 years. Their staff is knowledgeable & their response time is prompt.</p>
                            <h3>Nathan Felix</h3>
                            <span class="designation">CEO, High Rise Construction</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- testimonial-section end -->


        <!-- news-section -->
        <section class="news-section sec-pad">
            <div class="auto-container">
                <div class="sec-title centred">
                    <span class="sub-title">Blog</span>
                    <h2>Latest From Our Blog</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{asset('frontend/assets/images/news/news-1.jpg')}}" alt=""></figure>
                                    <div class="category"><a href="#">Manufacturing</a></div>
                                    <div class="view-btn"><a href="{{asset('frontend/assets/images/news/news-1.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                </div>
                                <div class="lower-content">
                                    <ul class="post-info clearfix">
                                        <li><i class="fa-regular fa-calendar"></i>14.10.2022</li>
                                        <li><i class="fa-regular fa-user"></i><a href="#">Lillian Grace</a></li>
                                    </ul>
                                    <h3><a href="#">Industry's Imperatives For Sustainability in...</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{asset('frontend/assets/images/news/news-2.jpg')}}" alt=""></figure>
                                    <div class="category"><a href="#">Smart Factory</a></div>
                                    <div class="view-btn"><a href="{{asset('frontend/assets/images/news/news-2.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                </div>
                                <div class="lower-content">
                                    <ul class="post-info clearfix">
                                        <li><i class="fa-regular fa-calendar"></i>28.09.2022</li>
                                        <li><i class="fa-regular fa-user"></i><a href="#">Oliver Jack</a></li>
                                    </ul>
                                    <h3><a href="#">Digital Manufacturing Week 2020 – Leading the Way</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{asset('frontend/assets/images/news/news-3.jpg')}}" alt=""></figure>
                                    <div class="category"><a href="#">Innovation</a></div>
                                    <div class="view-btn"><a href="{{asset('frontend/assets/images/news/news-3.jpg')}}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                </div>
                                <div class="lower-content">
                                    <ul class="post-info clearfix">
                                        <li><i class="fa-regular fa-calendar"></i>06.09.2022</li>
                                        <li><i class="fa-regular fa-user"></i><a href="#">Jacob Harry</a></li>
                                    </ul>
                                    <h3><a href="#">Building Back a Sustainable Manufacturing Sector</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- news-section end -->

@endsection