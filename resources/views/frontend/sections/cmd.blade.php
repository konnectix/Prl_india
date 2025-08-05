@extends('layouts.layout')
@section('styles')
<style>

</style>
@endsection
@section('content')

<section class="page-title centred">
    <div class="bg-layer" style="background-image: url({{ asset('frontend/assets/images/background/page-title.jpg') }});"></div>
    <div class="line-box">
        <div class="line-1"></div>
        <div class="line-2"></div>
    </div>
    <div class="auto-container">
        <div class="content-box">
            <h1>CMD Message</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="#">Home</a></li>
                <li>CMD</li>
                <li>Message</li>
            </ul>
        </div>
    </div>
</section>
<!-- page-title end -->


<!-- history-section -->
<section class="history-section">
    <div class="auto-container">
        <div class="inner-box">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                    <div class="image-box">
                        <figure class="image"><img src="{{ asset('frontend/assets/images/resource/history-1.jpg') }}" alt="" style="height: 400px; width: 100%; object-fit: cover;"></figure>
                        <div class="link-box"><a href="#"><i class="flaticon-diagonal-arrow"></i></a></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 content-column">
                    <div class="content-box">
                        <h2>From the desk of CMD</h2>
                        <div class="text">
                            <p><strong>Dear All,</strong></p>
                            <p>Premier Roadlines Limited has the necessary infrastructure to manage complex logistics demands efficiently and is dedicated to fulfilling our obligations to our clientele. At PRL, our top priority is ensuring the highest level of customer satisfaction while maintaining principles of trust and transparency with all stakeholders. Our team of professionals highly values partnerships and prioritizes relationships above all.</p>
                            <p>We continuously evolve as logistics providers, adhering to diverse HSSE (Health, Safety, Security, and Environment) protocols. Our future goals include environmentally conscious and well-organized logistics operations. As a publicly listed company, we are well-positioned for expansion into new verticals and maximizing value creation for all our stakeholders.</p>
                            <p>We are committed to serving the Indian logistics industry for many years.</p>
                            <p><strong>Regards,<br>Virender Gupta</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection