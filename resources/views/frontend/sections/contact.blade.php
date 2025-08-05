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
                    <h1>Get in Touch</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="#">Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- page-title end -->


        <!-- contact-info-section -->
        <section class="contact-info-section centred">
            <div class="auto-container">
                <div class="title-box">
                    <div class="icon-box"><i class="flaticon-headphones"></i></div>
                    <h2>Need Support? Talk with Team</h2>
                    <h3>Toll Free: <a href="tel:6132456789">(+61) 324 56 789</a></h3>
                </div>
                <div class="inner-container">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                            <div class="info-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="flaticon-pin"></i></div>
                                    <h3>Headquarters</h3>
                                    <p>54 Berrick 2nd Street Boston, MA <br />02115,United States.</p>
                                    <div class="link-box">
                                        <a href="#"><span>Find On Map</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                            <div class="info-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="flaticon-mail"></i></div>
                                    <h3>Send Mail</h3>
                                    <p><span>Supplier :</span> <a href="mailto:buss@example.com">buss@example.com</a><br /><span>Customer :</span> <a href="mailto:support@example.com">support@example.com</a></p>
                                    <div class="link-box">
                                        <a href="#"><span>Contact Form</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                            <div class="info-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="flaticon-clock"></i></div>
                                    <h3>Off. Hours</h3>
                                    <p>Mon - Satday : 08.00 am to 08.45 pm <br />Sunday : Closed. </p>
                                    <div class="link-box">
                                        <a href="#"><span>Make Appoitnment</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-info-section end -->


        <!-- contact-section -->
        <section class="contact-section sec-pad border-top border-bottom bg-color-1">
            <div class="auto-container">
                <div class="sec-title centred">
                    <span class="sub-title">Get In Touch</span>
                    <h2>Here to Help Our Customers</h2>
                </div>
            </div>
            <div class="tabs-box">
                <div class="tab-btn-box">
                    <div class="auto-container">
                        <ul class="tab-btns tab-buttons clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">Boston</li>
                            <li class="tab-btn" data-tab="#tab-2">California</li>
                            <li class="tab-btn" data-tab="#tab-3">Portland</li>
                            <li class="tab-btn" data-tab="#tab-4">New Orleans</li>
                        </ul>
                    </div>
                </div>
                <div class="outer-container">
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 map-column">
                                    <div class="map-inner">
                                        <iframe 
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s150%20Park%20Row%2C%20New%20York%2C%20NY%2010007%2C%20USA!5e0!3m2!1sen!2sin!4v1645000000000!5m2!1sen!2sin" 
                                            width="100%" 
                                            height="400" 
                                            style="border:0;" 
                                            allowfullscreen="" 
                                            loading="lazy">
                                        </iframe>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 content-column">
                                    <div class="content-inner">
                                        <div class="image-layer" style="background-image: url({{ asset('frontend/assets/images/resource/contact-1.jpg') }});"></div>
                                        <div class="content-box">
                                            <div class="upper-box">
                                                <h6>Location</h6>
                                                <p>54 Berrick 2nd Street <br />Boston, MA02115, United States.</p>
                                            </div>
                                            <div class="single-item">
                                                <h6>Contact Info</h6>
                                                <div class="row clearfix">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>Phone</p>
                                                            <p><a href="tel:8004567890102">+800 45 6789 01 & 02</a></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>E-mail</p>
                                                            <p><a href="mailto:enquiry@example.com">enquiry@example.com</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-item">
                                                <h6>Office Hours</h6>
                                                <div class="row clearfix">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>Mon to Fri</p>
                                                            <p>07.00 am to 10.00pm</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>Sat & Sun</p>
                                                            <p>08.00 am to 08.00pm</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-box">
                                                <a href="#" class="theme-btn btn-one"><span>Send Message</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 map-column">
                                    <div class="map-inner">
                                        <iframe 
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s150%20Park%20Row%2C%20New%20York%2C%20NY%2010007%2C%20USA!5e0!3m2!1sen!2sin!4v1645000000000!5m2!1sen!2sin" 
                                            width="100%" 
                                            height="400" 
                                            style="border:0;" 
                                            allowfullscreen="" 
                                            loading="lazy">
                                        </iframe>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 content-column">
                                    <div class="content-inner">
                                        <div class="image-layer" style="background-image: url({{ asset('frontend/assets/images/resource/contact-1.jpg') }});"></div>
                                        <div class="content-box">
                                            <div class="upper-box">
                                                <h6>Location</h6>
                                                <p>54 Berrick 2nd Street <br />Boston, MA02115, United States.</p>
                                            </div>
                                            <div class="single-item">
                                                <h6>Contact Info</h6>
                                                <div class="row clearfix">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>Phone</p>
                                                            <p><a href="tel:8004567890102">+800 45 6789 01 & 02</a></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>E-mail</p>
                                                            <p><a href="mailto:enquiry@example.com">enquiry@example.com</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-item">
                                                <h6>Office Hours</h6>
                                                <div class="row clearfix">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>Mon to Fri</p>
                                                            <p>07.00 am to 10.00pm</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>Sat & Sun</p>
                                                            <p>08.00 am to 08.00pm</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-box">
                                                <a href="#" class="theme-btn btn-one"><span>Send Message</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-3">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 map-column">
                                    <div class="map-inner">
                                        <iframe 
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s150%20Park%20Row%2C%20New%20York%2C%20NY%2010007%2C%20USA!5e0!3m2!1sen!2sin!4v1645000000000!5m2!1sen!2sin" 
                                            width="100%" 
                                            height="400" 
                                            style="border:0;" 
                                            allowfullscreen="" 
                                            loading="lazy">
                                        </iframe>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 content-column">
                                    <div class="content-inner">
                                        <div class="image-layer" style="background-image: url({{ asset('frontend/assets/images/resource/contact-1.jpg') }});"></div>
                                        <div class="content-box">
                                            <div class="upper-box">
                                                <h6>Location</h6>
                                                <p>54 Berrick 2nd Street <br />Boston, MA02115, United States.</p>
                                            </div>
                                            <div class="single-item">
                                                <h6>Contact Info</h6>
                                                <div class="row clearfix">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>Phone</p>
                                                            <p><a href="tel:8004567890102">+800 45 6789 01 & 02</a></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>E-mail</p>
                                                            <p><a href="mailto:enquiry@example.com">enquiry@example.com</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-item">
                                                <h6>Office Hours</h6>
                                                <div class="row clearfix">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>Mon to Fri</p>
                                                            <p>07.00 am to 10.00pm</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>Sat & Sun</p>
                                                            <p>08.00 am to 08.00pm</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-box">
                                                <a href="#" class="theme-btn btn-one"><span>Send Message</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-4">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 map-column">
                                    <div class="map-inner">
                                        <iframe 
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s150%20Park%20Row%2C%20New%20York%2C%20NY%2010007%2C%20USA!5e0!3m2!1sen!2sin!4v1645000000000!5m2!1sen!2sin" 
                                            width="100%" 
                                            height="400" 
                                            style="border:0;" 
                                            allowfullscreen="" 
                                            loading="lazy">
                                        </iframe>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 content-column">
                                    <div class="content-inner">
                                        <div class="image-layer" style="background-image: url({{ asset('frontend/assets/images/resource/contact-1.jpg') }});"></div>
                                        <div class="content-box">
                                            <div class="upper-box">
                                                <h6>Location</h6>
                                                <p>54 Berrick 2nd Street <br />Boston, MA02115, United States.</p>
                                            </div>
                                            <div class="single-item">
                                                <h6>Contact Info</h6>
                                                <div class="row clearfix">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>Phone</p>
                                                            <p><a href="tel:8004567890102">+800 45 6789 01 & 02</a></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>E-mail</p>
                                                            <p><a href="mailto:enquiry@example.com">enquiry@example.com</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-item">
                                                <h6>Office Hours</h6>
                                                <div class="row clearfix">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>Mon to Fri</p>
                                                            <p>07.00 am to 10.00pm</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                                        <div class="text">
                                                            <p>Sat & Sun</p>
                                                            <p>08.00 am to 08.00pm</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-box">
                                                <a href="#" class="theme-btn btn-one"><span>Send Message</span></a>
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
        <!-- contact-section end -->


        <!-- contact-style-two -->
        <section class="contact-style-two">
            <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-13.png') }});"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content-box">
                            <div class="sec-title">
                                <span class="sub-title">Send a Message</span>
                                <h2>Feel Free to Say Hello or Send Your Questions</h2>
                                <p>Complete the enquiry form & we will be in touch as soon as possible.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                        <div class="form-inner">
                            <form method="post" action="#">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Your Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email Address" required>
                                </div>
                                <div class="form-group">
                                    <div class="select-box">
                                        <select class="selectmenu">
                                            <option>Massachusetts</option>
                                            <option>Los Angeles</option>
                                            <option>Chicago</option>
                                            <option>Houston</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="Your Message"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn-two"><span>Send Message</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-style-two end -->


@endsection