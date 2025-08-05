<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PressCoverage;
use App\Models\PressCategory;
use App\Models\GalleryPhoto;
use App\Models\GalleryCategory;
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
        return view('frontend.sections.contact');
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
        return view('frontend.sections.video');
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
} 