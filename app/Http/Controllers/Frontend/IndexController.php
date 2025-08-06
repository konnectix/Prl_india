<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PressCoverage;
use App\Models\PressCategory;
use App\Models\GalleryPhoto;
use App\Models\GalleryCategory;
use App\Models\ContactLocation;
use App\Models\ContactInfo;
use App\Models\Video;
use App\Models\VideoCategory;
use App\Models\EsgCategory;
use App\Models\EsgArticle;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display the frontend homepage
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }

    /**
     * Display the about page
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('frontend.sections.about');
    }

    /**
     * Display the team page
     *
     * @return \Illuminate\View\View
     */
    public function team()
    {
        return view('frontend.sections.team');
    }

    /**
     * Display the certificate/projects page
     *
     * @return \Illuminate\View\View
     */
    public function certificate()
    {
        return view('frontend.sections.certificate');
    }

    /**
     * Display the service page
     *
     * @return \Illuminate\View\View
     */
    public function service()
    {
        return view('frontend.sections.service');
    }

    /**
     * Display the service details page
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function serviceDetails($id)
    {
        return view('frontend.sections.service-details', compact('id'));
    }

    /**
     * Display the blog page
     *
     * @return \Illuminate\View\View
     */
    public function blog()
    {
        return view('frontend.sections.blog');
    }

    /**
     * Display the blog details page
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function blogDetails($id)
    {
        return view('frontend.sections.blog-details', compact('id'));
    }

    /**
     * Display the investor/industries page
     *
     * @return \Illuminate\View\View
     */
    public function investor()
    {
        return view('frontend.sections.investor');
    }

    /**
     * Display the contact page
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        $locations = ContactLocation::active()->ordered()->get();
        $contactInfo = ContactInfo::active()->ordered()->get();
        
        // Group contact info by section for easier use in views
        $groupedContactInfo = $contactInfo->groupBy('section');
        
        return view('frontend.sections.contact', compact('locations', 'contactInfo', 'groupedContactInfo'));
    }

    /**
     * Display the press coverage/news page
     *
     * @return \Illuminate\View\View
     */
    public function pressCoverage(Request $request)
    {
        $query = PressCoverage::with('category')
            ->active()
            ->published()
            ->orderBy('published_date', 'desc')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc');

        // Filter by category if provided
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $articles = $query->paginate(3); // 3 articles per page to show pagination

        return view('frontend.sections.press-coverage', compact('articles'));
    }

    /**
     * Display the press coverage article details
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function pressCoverageDetails($id)
    {
        $article = PressCoverage::with('category')
            ->active()
            ->findOrFail($id);

        // Get related articles from the same category
        $relatedArticles = PressCoverage::with('category')
            ->active()
            ->published()
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->orderBy('published_date', 'desc')
            ->limit(3)
            ->get();

        return view('frontend.sections.press-coverage-details', compact('article', 'relatedArticles'));
    }

    /**
     * Display the photo gallery page
     *
     * @return \Illuminate\View\View
     */
    public function photo(Request $request)
    {
        // Get active categories with photo counts
        $categories = GalleryCategory::active()
            ->withCount(['photos as active_photos_count' => function($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Get photos query
        $query = GalleryPhoto::with('category')->active()->orderBy('sort_order')->orderBy('created_at', 'desc');

        // Filter by category if provided
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $photos = $query->paginate(9); // 9 photos per page

        // Calculate total photos count
        $totalPhotos = GalleryPhoto::active()->count();

        return view('frontend.sections.photo', compact('photos', 'categories', 'totalPhotos'));
    }

    /**
     * Display the video gallery page
     *
     * @return \Illuminate\View\View
     */
    public function video()
    {
        $videos = Video::with('category')->active()->ordered()->paginate(9);
        $categories = VideoCategory::active()->ordered()->get();
        $totalVideos = Video::active()->count();

        return view('frontend.sections.video', compact('videos', 'categories', 'totalVideos'));
    }

    /**
     * Display the CMD page
     *
     * @return \Illuminate\View\View
     */
    public function cmd()
    {
        return view('frontend.sections.cmd');
    }

    /**
     * Display the ESG page with categories overview
     *
     * @return \Illuminate\View\View
     */
    public function esg()
    {
        $categories = EsgCategory::active()
            ->ordered()
            ->withCount(['articles' => function($query) {
                $query->active()->published();
            }])
            ->get();

        return view('frontend.sections.esg', compact('categories'));
    }

    /**
     * Display articles for a specific ESG category
     *
     * @param EsgCategory $category
     * @return \Illuminate\View\View
     */
    public function esgCategory(EsgCategory $category)
    {
        $articles = EsgArticle::active()
            ->published()
            ->byCategory($category->id)
            ->ordered()
            ->paginate(12);

        return view('frontend.sections.esg-category', compact('category', 'articles'));
    }

    /**
     * Display a specific ESG article details
     *
     * @param EsgCategory $category
     * @param EsgArticle $article
     * @return \Illuminate\View\View
     */
    public function esgDetails(EsgCategory $category, EsgArticle $article)
    {
        // Ensure the article belongs to the category
        if ($article->category_id !== $category->id) {
            abort(404);
        }

        // Increment view count
        $article->incrementViewCount();

        // Get related articles from the same category
        $relatedArticles = EsgArticle::active()
            ->published()
            ->byCategory($category->id)
            ->where('id', '!=', $article->id)
            ->ordered()
            ->take(3)
            ->get();

        // Get all ESG categories for sidebar
        $esgCategories = EsgCategory::active()->ordered()->get();

        return view('frontend.sections.esg-article', compact('category', 'article', 'relatedArticles', 'esgCategories'));
    }
} 