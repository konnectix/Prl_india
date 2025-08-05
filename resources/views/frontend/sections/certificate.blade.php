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
                    <h1>Certificates</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="#">Home</a></li>
                        <li>Overview</li>
                        <li>Certificates</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- page-title end -->


        <!-- project-section -->
        <section class="project-section">
            <div class="sortable-masonry">
                <div class="filters centred">
                    <div class="auto-container">
                        <ul class="filter-tabs filter-btns clearfix">
                            <li class="active filter" data-role="button" data-filter=".all">All <span>[35]</span></li>
                            <li class="filter" data-role="button" data-filter=".construction">Construction</li>
                            <li class="filter" data-role="button" data-filter=".engineering">Engineering</li>
                            <li class="filter" data-role="button" data-filter=".technology">Technology</li>
                            <li class="filter" data-role="button" data-filter=".material">Material</li>
                        </ul>
                    </div>
                </div>
                <div class="auto-container">
                    <div class="items-container row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all technology construction engineering">
                            <div class="project-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/assets/images/project/project-1.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/project/project-1.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                        <div class="text">
                                            <h3><a href="#">Sheet Metal Bending</a></h3>
                                            <h5>Technology</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all construction technology material">
                            <div class="project-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/assets/images/project/project-2.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/project/project-2.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                        <div class="text">
                                            <h3><a href="#">Sheet Metal Bending</a></h3>
                                            <h5>Technology</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all technology engineering">
                            <div class="project-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/assets/images/project/project-3.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/project/project-3.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                        <div class="text">
                                            <h3><a href="#">Sheet Metal Bending</a></h3>
                                            <h5>Technology</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all construction engineering material">
                            <div class="project-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/assets/images/project/project-4.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/project/project-4.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                        <div class="text">
                                            <h3><a href="#">Sheet Metal Bending</a></h3>
                                            <h5>Technology</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all technology engineering">
                            <div class="project-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/assets/images/project/project-5.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/project/project-5.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                        <div class="text">
                                            <h3><a href="#">Sheet Metal Bending</a></h3>
                                            <h5>Technology</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all construction material">
                            <div class="project-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/assets/images/project/project-6.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/project/project-6.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                        <div class="text">
                                            <h3><a href="#">Sheet Metal Bending</a></h3>
                                            <h5>Technology</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all technology engineering">
                            <div class="project-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/assets/images/project/project-7.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/project/project-7.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                        <div class="text">
                                            <h3><a href="#">Sheet Metal Bending</a></h3>
                                            <h5>Technology</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all construction material">
                            <div class="project-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/assets/images/project/project-8.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/project/project-8.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                        <div class="text">
                                            <h3><a href="#">Sheet Metal Bending</a></h3>
                                            <h5>Technology</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all technology engineering">
                            <div class="project-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset('frontend/assets/images/project/project-9.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/project/project-9.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                        <div class="text">
                                            <h3><a href="#">Sheet Metal Bending</a></h3>
                                            <h5>Technology</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- project-section end -->

@endsection