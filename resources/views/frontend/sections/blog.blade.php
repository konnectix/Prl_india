@extends('layouts.layout')
@section('styles')
<style>
.blog-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.blog-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 8px 8px 0 0;
}

.blog-category {
    background: #007bff;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    position: absolute;
    top: 15px;
    left: 15px;
}

.blog-meta {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 15px;
}

.blog-excerpt {
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
}

.read-more-btn {
    background: #007bff;
    border: none;
    color: white;
    padding: 10px 25px;
    border-radius: 25px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.read-more-btn:hover {
    background: #0056b3;
    color: white;
    transform: translateY(-2px);
    text-decoration: none;
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
                    <h1>Blog</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li>Blog</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- page-title end -->

        <!-- blog-grid -->
        <section class="blog-grid">
            <div class="auto-container">
                <div class="row clearfix">
                    <!-- Blog Post 1 -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="blog-card">
                            <div style="position: relative;">
                                <img src="{{ asset('frontend/assets/images/news/news-1.jpg') }}" alt="Blog Post" class="blog-image">
                                <div class="blog-category">Technology</div>
                            </div>
                            <div class="card-body p-4">
                                <div class="blog-meta">
                                    <i class="fas fa-calendar mr-2"></i>March 15, 2024
                                    <span class="ml-3"><i class="fas fa-user mr-1"></i>Admin</span>
                                </div>
                                <h3 class="mb-3">Digital Transformation in Logistics</h3>
                                <div class="blog-excerpt">
                                    Exploring how digital technologies are revolutionizing the logistics industry and improving supply chain efficiency.
                                </div>
                                <a href="{{ route('frontend.blog-details', 1) }}" class="read-more-btn">
                                    Read More <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post 2 -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="blog-card">
                            <div style="position: relative;">
                                <img src="{{ asset('frontend/assets/images/news/news-2.jpg') }}" alt="Blog Post" class="blog-image">
                                <div class="blog-category">Industry</div>
                            </div>
                            <div class="card-body p-4">
                                <div class="blog-meta">
                                    <i class="fas fa-calendar mr-2"></i>March 12, 2024
                                    <span class="ml-3"><i class="fas fa-user mr-1"></i>Admin</span>
                                </div>
                                <h3 class="mb-3">Sustainable Supply Chain Practices</h3>
                                <div class="blog-excerpt">
                                    Learn about sustainable practices that are shaping the future of supply chain management and logistics operations.
                                </div>
                                <a href="{{ route('frontend.blog-details', 2) }}" class="read-more-btn">
                                    Read More <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post 3 -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="blog-card">
                            <div style="position: relative;">
                                <img src="{{ asset('frontend/assets/images/news/news-3.jpg') }}" alt="Blog Post" class="blog-image">
                                <div class="blog-category">Innovation</div>
                            </div>
                            <div class="card-body p-4">
                                <div class="blog-meta">
                                    <i class="fas fa-calendar mr-2"></i>March 10, 2024
                                    <span class="ml-3"><i class="fas fa-user mr-1"></i>Admin</span>
                                </div>
                                <h3 class="mb-3">AI in Warehouse Management</h3>
                                <div class="blog-excerpt">
                                    Discover how artificial intelligence is optimizing warehouse operations and improving inventory management.
                                </div>
                                <a href="{{ route('frontend.blog-details', 3) }}" class="read-more-btn">
                                    Read More <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post 4 -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="blog-card">
                            <div style="position: relative;">
                                <img src="{{ asset('frontend/assets/images/news/news-7.jpg') }}" alt="Blog Post" class="blog-image">
                                <div class="blog-category">Logistics</div>
                            </div>
                            <div class="card-body p-4">
                                <div class="blog-meta">
                                    <i class="fas fa-calendar mr-2"></i>March 08, 2024
                                    <span class="ml-3"><i class="fas fa-user mr-1"></i>Admin</span>
                                </div>
                                <h3 class="mb-3">Last-Mile Delivery Optimization</h3>
                                <div class="blog-excerpt">
                                    Strategies and technologies for optimizing last-mile delivery to improve customer satisfaction and reduce costs.
                                </div>
                                <a href="{{ route('frontend.blog-details', 4) }}" class="read-more-btn">
                                    Read More <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post 5 -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="blog-card">
                            <div style="position: relative;">
                                <img src="{{ asset('frontend/assets/images/news/news-8.jpg') }}" alt="Blog Post" class="blog-image">
                                <div class="blog-category">Technology</div>
                            </div>
                            <div class="card-body p-4">
                                <div class="blog-meta">
                                    <i class="fas fa-calendar mr-2"></i>March 05, 2024
                                    <span class="ml-3"><i class="fas fa-user mr-1"></i>Admin</span>
                                </div>
                                <h3 class="mb-3">IoT in Supply Chain Visibility</h3>
                                <div class="blog-excerpt">
                                    How Internet of Things (IoT) devices are providing real-time visibility across the entire supply chain.
                                </div>
                                <a href="{{ route('frontend.blog-details', 5) }}" class="read-more-btn">
                                    Read More <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Post 6 -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="blog-card">
                            <div style="position: relative;">
                                <img src="{{ asset('frontend/assets/images/news/news-9.jpg') }}" alt="Blog Post" class="blog-image">
                                <div class="blog-category">Industry</div>
                            </div>
                            <div class="card-body p-4">
                                <div class="blog-meta">
                                    <i class="fas fa-calendar mr-2"></i>March 03, 2024
                                    <span class="ml-3"><i class="fas fa-user mr-1"></i>Admin</span>
                                </div>
                                <h3 class="mb-3">E-commerce Logistics Trends</h3>
                                <div class="blog-excerpt">
                                    Current trends and future outlook for e-commerce logistics in the rapidly evolving digital marketplace.
                                </div>
                                <a href="{{ route('frontend.blog-details', 6) }}" class="read-more-btn">
                                    Read More <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper centred">
                    <ul class="pagination clearfix">
                        <li><span><i class="flaticon-left-chevron"></i></span></li>
                        <li><a href="#" class="current">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="flaticon-right-chevron"></i></a></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- blog-grid end -->

@endsection