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
                    <h1>Service Details</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="#">Home</a></li>
                        <li>Services</li>
                        <li>Service Detail</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- page-title end -->


        <!-- service-details -->
        <section class="service-details">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="service-sidebar">
                            <div class="category-widget">
                                <div class="widget-title">
                                    <h3>Services</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="category-list clearfix"> 
                                        <li><a href="#" class="current">Centerless Grinding<i class="flaticon-right-chevron"></i></a></li>
                                        <li><a href="#">Laser & Plasma<i class="flaticon-right-chevron"></i></a></li>
                                        <li><a href="#">Metal & Tungsten<i class="flaticon-right-chevron"></i></a></li>
                                        <li><a href="#">Three-Point Bending<i class="flaticon-right-chevron"></i></a></li>
                                        <li><a href="#">Spot Weld Assembly<i class="flaticon-right-chevron"></i></a></li>
                                        <li><a href="#">Mass Production<i class="flaticon-right-chevron"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="contact-widget">
                                <div class="widget-title">
                                    <h3>For Enquiry</h3>
                                </div>
                                <div class="widget-content">
                                    <div class="customer-support">
                                        <figure class="thumb-box"><img src="{{ asset('frontend/assets/images/service/thumb-1.jpg') }}" alt=""></figure>
                                        <h3>Luna <br />Hennah</h3>
                                        <span class="designation">Exe.Assistant</span>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <div class="icon-box"><i class="flaticon-dial-pad"></i></div>
                                            <h5>Phone</h5>
                                            <p><a href="tel:6132456789">(+61) 324 56 789</a></p>
                                        </li>
                                        <li>
                                            <div class="icon-box"><i class="flaticon-mail"></i></div>
                                            <h5>Email</h5>
                                            <p><a href="mailto:lunahennah@example.com">lunahennah@example.com</a></p>
                                        </li>
                                    </ul>
                                    <div class="btn-box">
                                        <a href="#" class="theme-btn btn-one"><span>Make an Appoinment</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="service-details-content">
                            <div class="content-one">
                                <h2>Centerless Grinding</h2>
                                <div class="image-box">
                                    <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/service/service-11.jpg') }}" alt=""></figure>
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/service/service-11.jpg') }}" alt=""></figure>
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/service/service-11.jpg') }}" alt=""></figure>
                                    </div>
                                </div>
                                <div class="text">
                                    <h4>Our Advanced Robotics Keep the Assembly Lines Consistent</h4>
                                    <p>Demoralized by the charms of pleasure the moment blinded by desired that they cannot foresee that pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their which is the same as saying through shrinking foresee the pain and trouble idea of denouncings master-builder of human happiness no one rejects dislikes or avoids.</p>
                                </div>
                            </div>
                           
                            <div class="content-three">
                                <div class="upper-box">
                                    <h3>Features</h3>
                                    <p>Moment blinded by desired that they cannot foresee that pain and trouble that are bound to which is the same as saying through shrinking foresee.</p>
                                </div>
                                <div class="tabs-box">
                                    <div class="tab-btn-box">
                                        <div class="bg-layer" style="background-image: url({{ asset('frontend/assets/images/service/service-14.jpg') }});"></div>
                                        <ul class="tab-btns tab-buttons clearfix">
                                            <li class="tab-btn active-btn" data-tab="#tab-1">Short Loading Time<i class="flaticon-diagonal-arrow"></i></li>
                                            <li class="tab-btn" data-tab="#tab-2">Large Quantities<i class="flaticon-diagonal-arrow"></i></li>
                                            <li class="tab-btn" data-tab="#tab-3">Longer Yield<i class="flaticon-diagonal-arrow"></i></li>
                                        </ul>
                                    </div>
                                    <div class="tabs-content">
                                        <div class="tab active-tab" id="tab-1">
                                            <div class="inner-box">
                                                <div class="title-box">
                                                    <h6>Benefit 01</h6>
                                                    <h3>Loading Time can be Minimized</h3>
                                                </div>
                                                <div class="text">
                                                    <p>Lookout flogging bilge rat main shet bilge water nipper fluke to go on account heave down clap of thunder else  endures pains to avoid worse pains.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab" id="tab-2">
                                            <div class="inner-box">
                                                <div class="title-box">
                                                    <h6>Benefit 02</h6>
                                                    <h3>Large Quantities can be Minimized</h3>
                                                </div>
                                                <div class="text">
                                                    <p>Lookout flogging bilge rat main shet bilge water nipper fluke to go on account heave down clap of thunder else  endures pains to avoid worse pains.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab" id="tab-3">
                                            <div class="inner-box">
                                                <div class="title-box">
                                                    <h6>Benefit 03</h6>
                                                    <h3>Longer Yield can be Minimized</h3>
                                                </div>
                                                <div class="text">
                                                    <p>Lookout flogging bilge rat main shet bilge water nipper fluke to go on account heave down clap of thunder else  endures pains to avoid worse pains.</p>
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
        </section>
        <!-- service-details end -->

@endsection