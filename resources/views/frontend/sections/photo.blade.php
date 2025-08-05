@extends('layouts.layout')
@section('styles')
<style>
.load-more-container {
    text-align: center;
    margin-top: 30px;
}

.disabled {
    opacity: 0.6;
    cursor: not-allowed !important;
    pointer-events: none;
}

.no-photos-message {
    text-align: center;
    padding: 50px 0;
    color: #666;
}

.no-photos-message h4 {
    margin-bottom: 15px;
    color: #333;
}
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
                    <h1>Photo Gallery</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li>Photo Gallery</li>
                        
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
                            <li class="active filter" data-role="button" data-filter=".all">
                                All <span>[{{ $totalPhotos }}]</span>
                            </li>
                            @foreach($categories as $category)
                                @if($category->active_photos_count > 0)
                                    <li class="filter" data-role="button" data-filter=".category-{{ $category->id }}">
                                        {{ $category->name }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="auto-container">
                    <div class="items-container row clearfix">
                        @forelse($photos as $photo)
                            <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all category-{{ $photo->category_id }}">
                                <div class="project-block-one">
                                    <div class="inner-box">
                                        <figure class="image-box">
                                            <img src="{{ $photo->full_image_url }}" alt="{{ $photo->alt_text ?? $photo->title }}">
                                        </figure>
                                        <div class="content-box">
                                            <div class="view-btn">
                                                <a href="{{ $photo->full_image_url }}" class="lightbox-image" data-fancybox="gallery">
                                                    <i class="flaticon-zoom-in"></i>
                                                </a>
                                            </div>
                                            <div class="text">
                                                <h3><a href="#">{{ $photo->title }}</a></h3>
                                                @if($photo->category)
                                                    <h5>{{ $photo->category->name }}</h5>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="no-photos-message">
                                    <h4>No photos available</h4>
                                    <p>Please check back later for updates to our photo gallery.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    
                    @if($photos->count() > 0 && $photos->hasPages())
                        <div class="more-btn centred">
                            @if($photos->hasMorePages())
                                <a href="{{ $photos->nextPageUrl() }}" class="theme-btn btn-two">
                                    <span>Load More</span>
                                </a>
                            @else
                                <span class="theme-btn btn-two disabled" style="opacity: 0.6; cursor: not-allowed;">
                                    <span>No More Photos</span>
                                </span>
                            @endif
                        </div>
                    @elseif($photos->count() == 0)
                        <div class="more-btn centred">
                            <div class="text-center" style="padding: 50px 0;">
                                <h4>No photos available</h4>
                                <p>Please check back later for updates.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- project-section end -->

@endsection