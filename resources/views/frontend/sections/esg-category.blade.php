@extends('layouts.layout')
@section('styles')
<style>
.category-header {
    background: linear-gradient(135deg, {{ $category->color ?? '#007bff' }}20, {{ $category->color ?? '#007bff' }}10);
    border-left: 5px solid {{ $category->color ?? '#007bff' }};
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 30px;
}

.category-banner {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 20px;
}

.article-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.article-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.article-meta {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 15px;
}

.article-excerpt {
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
}

.read-more-btn {
    background: {{ $category->color ?? '#007bff' }};
    border: none;
    color: white;
    padding: 10px 25px;
    border-radius: 25px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.read-more-btn:hover {
    background: {{ $category->color ?? '#007bff' }}dd;
    color: white;
    transform: translateY(-2px);
    text-decoration: none;
}

.back-btn {
    color: {{ $category->color ?? '#007bff' }};
    text-decoration: none;
    margin-bottom: 20px;
    display: inline-block;
}

.back-btn:hover {
    color: {{ $category->color ?? '#007bff' }}dd;
    text-decoration: none;
}

.view-count {
    color: #999;
    font-size: 0.8rem;
}

.featured-badge {
    background: {{ $category->color ?? '#007bff' }};
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    position: absolute;
    top: 15px;
    right: 15px;
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
                    <h1>{{ $category->name }} - ESG</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li><a href="{{ route('frontend.esg') }}">ESG</a></li>
                        <li>{{ $category->name }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- page-title end -->

        <!-- ESG Category Articles Section -->
        <section class="blog-grid">
            <div class="auto-container">
                <!-- Back Button -->
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('frontend.esg') }}" class="back-btn">
                            <i class="fas fa-arrow-left mr-2"></i> Back to ESG Categories
                        </a>
                    </div>
                </div>

                <!-- Category Header -->
                <div class="row">
                    <div class="col-12">
                        <div class="category-header">
                            @if($category->banner_image)
                                <img src="{{ $category->full_banner_image_url }}" alt="{{ $category->name }}" class="category-banner">
                            @endif
                            <h2 class="mb-3" style="color: {{ $category->color ?? '#007bff' }};">{{ $category->name }}</h2>
                            @if($category->description)
                                <p class="lead mb-0">{{ $category->description }}</p>
                            @endif
                            <div class="mt-3">
                                <span class="badge badge-light mr-2">{{ $articles->total() }} Articles</span>
                                <span class="badge badge-light">{{ $category->getActiveArticlesCount() }} Published</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Articles Grid -->
                <div class="row clearfix">
                    @forelse($articles as $article)
                        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                            <div class="article-card">
                                <div class="card-body p-4" style="position: relative;">
                                    @if($article->is_featured)
                                        <div class="featured-badge">Featured</div>
                                    @endif
                                    
                                    @if($article->featured_image)
                                        <img src="{{ $article->full_featured_image_url }}" alt="{{ $article->title }}" class="w-100 mb-3" style="height: 200px; object-fit: cover; border-radius: 8px;">
                                    @endif
                                    
                                    <div class="article-meta">
                                        <i class="fas fa-calendar mr-2"></i>{{ $article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y') }}
                                        @if($article->views_count > 0)
                                            <span class="view-count ml-3">
                                                <i class="fas fa-eye mr-1"></i>{{ $article->views_count }} views
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <h3 class="mb-3">{{ $article->title }}</h3>
                                    
                                    @if($article->excerpt)
                                        <div class="article-excerpt">{{ $article->excerpt }}</div>
                                    @elseif($article->content)
                                        <div class="article-excerpt">{{ Str::limit(strip_tags($article->content), 150) }}</div>
                                    @endif
                                    
                                    <a href="{{ route('frontend.esg-article', [$category->slug, $article->slug]) }}" class="read-more-btn">
                                        Read More <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-file-alt fa-4x text-muted mb-4"></i>
                                <h3 class="text-muted">No Articles Found</h3>
                                <p class="text-muted">There are no published articles in this category yet.</p>
                                <a href="{{ route('frontend.esg') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left mr-2"></i> Back to ESG Categories
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
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
        <!-- ESG Category Articles Section end -->

@endsection
