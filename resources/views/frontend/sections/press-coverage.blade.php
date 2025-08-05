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
                    <h1>Press Coverage</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li>Press Coverage</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- page-title end -->

        <!-- blog-grid -->
        <section class="blog-grid">
            <div class="auto-container">
                <div class="row clearfix">
                    @forelse($articles as $article)
                        <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            @if($article->featured_image)
                                                <img src="{{ $article->full_featured_image_url }}" alt="{{ $article->title }}">
                                            @else
                                                <img src="{{ asset('frontend/assets/images/news/news-1.jpg') }}" alt="{{ $article->title }}">
                                            @endif
                                        </figure>
                                        @if($article->category)
                                            <div class="category">
                                                <a href="{{ route('frontend.press-coverage', ['category' => $article->category->id]) }}">{{ $article->category->name }}</a>
                                            </div>
                                        @endif
                                        <div class="view-btn">
                                            @if($article->featured_image)
                                                <a href="{{ $article->full_featured_image_url }}" class="lightbox-image" data-fancybox="gallery">
                                                    <i class="flaticon-zoom-in"></i>
                                                </a>
                                            @else
                                                <a href="{{ asset('frontend/assets/images/news/news-1.jpg') }}" class="lightbox-image" data-fancybox="gallery">
                                                    <i class="flaticon-zoom-in"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="lower-content">
                                        <h3>
                                            @if($article->external_url)
                                                <a href="{{ $article->external_url }}" target="_blank" rel="noopener">{{ $article->title }}</a>
                                            @else
                                                <a href="{{ route('frontend.press-coverage-details', $article->id) }}">{{ $article->title }}</a>
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/news/news-1.jpg') }}" alt=""></figure>
                                        <div class="category"><a href="#">Manufacturing</a></div>
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/news/news-1.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Industry's Imperatives For Sustainability in...</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/news/news-2.jpg') }}" alt=""></figure>
                                        <div class="category"><a href="#">Smart Factory</a></div>
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/news/news-2.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Digital Manufacturing Week 2020 – Leading the Way</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/news/news-3.jpg') }}" alt=""></figure>
                                        <div class="category"><a href="#">Innovation</a></div>
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/news/news-3.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Building Back a Sustainable Manufacturing Sector</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/news/news-7.jpg') }}" alt=""></figure>
                                        <div class="category"><a href="#">Innovation</a></div>
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/news/news-7.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Building Back a Sustainable Manufacturing Sector</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/news/news-8.jpg') }}" alt=""></figure>
                                        <div class="category"><a href="#">Manufacturing</a></div>
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/news/news-8.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Industry's Imperatives For Sustainability in...</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset('frontend/assets/images/news/news-9.jpg') }}" alt=""></figure>
                                        <div class="category"><a href="#">Smart Factory</a></div>
                                        <div class="view-btn"><a href="{{ asset('frontend/assets/images/news/news-9.jpg') }}" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-zoom-in"></i></a></div>
                                    </div>
                                    <div class="lower-content">
                                        <h3><a href="#">Digital Manufacturing Week 2020 – Leading the Way</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                @if($articles->hasPages())
                    <div class="pagination-wrapper centred">
                        <ul class="pagination clearfix">
                            {{-- Previous Page Link --}}
                            @if ($articles->onFirstPage())
                                <li><span><i class="flaticon-left-chevron"></i></span></li>
                            @else
                                <li><a href="{{ $articles->appends(request()->query())->previousPageUrl() }}"><i class="flaticon-left-chevron"></i></a></li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                                @if ($page == $articles->currentPage())
                                    <li><a href="#" class="current">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $articles->appends(request()->query())->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($articles->hasMorePages())
                                <li><a href="{{ $articles->appends(request()->query())->nextPageUrl() }}"><i class="flaticon-right-chevron"></i></a></li>
                            @else
                                <li><span><i class="flaticon-right-chevron"></i></span></li>
                            @endif
                        </ul>
                    </div>
                @endif
            </div>
        </section>
        <!-- blog-grid end -->

@endsection