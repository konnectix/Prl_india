
@extends('layouts.layout')
@section('styles')
<style>
    .video-block {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .video-block:hover {
        transform: translateY(-5px);
    }
    
    .video-thumbnail {
        position: relative;
        width: 100%;
        height: 250px;
        overflow: hidden;
    }
    
    .video-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .video-block:hover .video-thumbnail img {
        transform: scale(1.05);
    }
    
    .play-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .play-overlay:hover {
        background: rgba(255, 255, 255, 1);
        transform: translate(-50%, -50%) scale(1.1);
    }
    
    .play-overlay i {
        color: #333;
        font-size: 24px;
        margin-left: 3px;
    }
    
    .video-duration {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 2px 6px;
        border-radius: 3px;
        font-size: 12px;
    }
    
    .video-info {
        padding: 20px;
        background: white;
    }
    
    .video-info h3 {
        margin: 0 0 8px 0;
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }
    
    .video-info .category {
        color: #666;
        font-size: 14px;
        margin-bottom: 8px;
    }
    
    .video-info .description {
        color: #777;
        font-size: 13px;
        line-height: 1.4;
    }
    
    .filter-tabs li {
        position: relative;
        transition: all 0.3s ease;
    }
    
    .filter-tabs li.active {
        color: #dc3545 !important; /* Red text color for active filter */
    }
    
    .filter-tabs li.active span {
        color: #dc3545 !important; /* Red text color for count */
    }
    
    .filter-tabs li:hover {
        color: #c82333; /* Darker red text on hover */
    }
    
    /* Video Modal Styles */
    .video-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.9);
    }
    
    .video-modal-content {
        position: relative;
        margin: 5% auto;
        width: 80%;
        max-width: 900px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .video-modal video,
    .video-modal iframe {
        width: 100%;
        height: 500px;
        border: none;
    }
    
    .video-modal-close {
        position: absolute;
        top: -40px;
        right: 0;
        color: white;
        font-size: 30px;
        cursor: pointer;
        z-index: 10000;
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
                    <h1>Video Gallery</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li>Video Gallery</li>
                        
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
                            <li class="active filter" data-role="button" data-filter=".all">All <span>[{{ $totalVideos }}]</span></li>
                            @foreach($categories as $category)
                                <li class="filter" data-role="button" data-filter=".category-{{ $category->id }}" style="--category-color: {{ $category->color }}">
                                    {{ $category->name }}
                                    <span>[{{ $category->videos_count }}]</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="auto-container">
                    <div class="items-container row clearfix">
                        @forelse($videos as $video)
                            <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all category-{{ $video->category_id }}">
                                <div class="video-block">
                                    <div class="video-thumbnail">
                                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->alt_text ?? $video->title }}">
                                        <div class="play-overlay" data-video-id="{{ $video->id }}" data-video-type="{{ $video->video_type }}" data-video-url="{{ $video->embed_url }}">
                                            <i class="fas fa-play"></i>
                                        </div>
                                        @if($video->duration)
                                            <div class="video-duration">{{ gmdate('i:s', $video->duration) }}</div>
                                        @endif
                                    </div>
                                    <div class="video-info">
                                        <h3>{{ $video->title }}</h3>
                                        @if($video->category)
                                            <div class="category">{{ $video->category->name }}</div>
                                        @endif
                                        @if($video->description)
                                            <div class="description">{{ Str::limit($video->description, 100) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="no-videos-message text-center">
                                    <h4>No videos available</h4>
                                    <p>Please check back later for updates to our video gallery.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    
                    @if($videos->hasPages())
                        @if($videos->hasMorePages())
                            <div class="more-btn centred">
                                <a href="{{ $videos->nextPageUrl() }}" class="theme-btn btn-two load-more-videos">
                                    <span>Load More</span>
                                </a>
                            </div>
                        @else
                            <div class="more-btn centred">
                                <div class="no-more-message">
                                    <p>No More Videos</p>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </section>
        <!-- project-section end -->

        <!-- Video Modal -->
        <div id="videoModal" class="video-modal">
            <div class="video-modal-content">
                <span class="video-modal-close">&times;</span>
                <div id="videoContainer"></div>
            </div>
        </div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const playButtons = document.querySelectorAll('.play-overlay');
    const modal = document.getElementById('videoModal');
    const modalClose = document.querySelector('.video-modal-close');
    const videoContainer = document.getElementById('videoContainer');
    
    // Play button click handlers
    playButtons.forEach(button => {
        button.addEventListener('click', function() {
            const videoId = this.dataset.videoId;
            const videoType = this.dataset.videoType;
            const videoUrl = this.dataset.videoUrl;
            
            openVideoModal(videoType, videoUrl, videoId);
        });
    });
    
    // Modal close handlers
    modalClose.addEventListener('click', closeVideoModal);
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeVideoModal();
        }
    });
    
    // Escape key to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'block') {
            closeVideoModal();
        }
    });
    
    function openVideoModal(videoType, videoUrl, videoId) {
        let videoElement = '';
        
        if (videoType === 'youtube') {
            videoElement = `<iframe src="${videoUrl}?autoplay=1" frameborder="0" allowfullscreen></iframe>`;
        } else if (videoType === 'vimeo') {
            videoElement = `<iframe src="${videoUrl}?autoplay=1" frameborder="0" allowfullscreen></iframe>`;
        } else if (videoType === 'upload') {
            videoElement = `<video controls autoplay><source src="${videoUrl}" type="video/mp4">Your browser does not support the video tag.</video>`;
        } else {
            videoElement = `<iframe src="${videoUrl}" frameborder="0" allowfullscreen></iframe>`;
        }
        
        videoContainer.innerHTML = videoElement;
        modal.style.display = 'block';
        
        // Increment view count
        if (videoId) {
            fetch(`/api/videos/${videoId}/view`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            }).catch(console.error);
        }
    }
    
    function closeVideoModal() {
        modal.style.display = 'none';
        videoContainer.innerHTML = '';
    }
    
    // Filter functionality (if using Isotope)
    if (typeof $ !== 'undefined' && $.fn.isotope) {
        const $container = $('.items-container');
        
        $container.isotope({
            itemSelector: '.masonry-item',
            layoutMode: 'masonry'
        });
        
        $('.filter').on('click', function() {
            const filterValue = $(this).attr('data-filter');
            
            $('.filter').removeClass('active');
            $(this).addClass('active');
            
            $container.isotope({ filter: filterValue });
        });
    }
});
</script>
@endsection