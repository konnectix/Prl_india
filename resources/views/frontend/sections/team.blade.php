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
                    <h1>Our Team</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="#">Home</a></li>
                        <li>Overview</li>
                        <li>Team</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- page-title end -->


        <!-- team-section -->
        <section class="team-section">
            <div class="auto-container">
                <div class="inner-container">
                    <span class="big-text one">Team Members</span>
                    <span class="big-text two">Team Members</span>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                            <div class="team-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/team/team-1.jpg') }}" alt=""></figure>
                                        <span class="designation">ceo & Founder</span>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Michael Ezra</a></h3>
                                        <p>Experienced leader with over 15 years in manufacturing industry. Passionate about innovation and sustainable business practices.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                            <div class="team-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/team/team-2.jpg') }}" alt=""></figure>
                                        <span class="designation">President</span>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Gerald Ivor</a></h3>
                                        <p>Strategic visionary with expertise in business development and market expansion. Committed to driving organizational growth and excellence.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                            <div class="team-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/team/team-3.jpg') }}" alt=""></figure>
                                        <span class="designation">Vice President</span>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Nora Lillian</a></h3>
                                        <p>Dynamic executive with strong operational leadership skills. Focuses on process optimization and team development initiatives.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                            <div class="team-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/team/team-4.jpg') }}" alt=""></figure>
                                        <span class="designation">Exe.Assistant</span>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Luna Hennah</a></h3>
                                        <p>Efficient coordinator with excellent organizational abilities. Ensures smooth communication and project management across departments.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                            <div class="team-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/team/team-5.jpg') }}" alt=""></figure>
                                        <span class="designation">Financial Officer</span>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Mark kevin</a></h3>
                                        <p>Financial expert with deep knowledge of corporate finance and investment strategies. Dedicated to maintaining fiscal responsibility and growth.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                            <div class="team-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/team/team-6.jpg') }}" alt=""></figure>
                                        <span class="designation">Marketing Officer</span>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Leah Violet</a></h3>
                                        <p>Creative marketing professional with innovative campaign strategies. Specializes in brand development and customer engagement solutions.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                            <div class="team-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/team/team-3.jpg') }}" alt=""></figure>
                                        <span class="designation">Vice President</span>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Nora Lillian</a></h3>
                                        <p>Dynamic executive with strong operational leadership skills. Focuses on process optimization and team development initiatives.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                            <div class="team-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/team/team-1.jpg') }}" alt=""></figure>
                                        <span class="designation">ceo & Founder</span>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Michael Ezra</a></h3>
                                        <p>Experienced leader with over 15 years in manufacturing industry. Passionate about innovation and sustainable business practices.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                            <div class="team-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/team/team-2.jpg') }}" alt=""></figure>
                                        <span class="designation">President</span>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Gerald Ivor</a></h3>
                                        <p>Strategic visionary with expertise in business development and market expansion. Committed to driving organizational growth and excellence.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- team-section end -->


@endsection