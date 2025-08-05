<?php

namespace Database\Seeders;

use App\Models\PressCategory;
use App\Models\PressCoverage;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PressSeeder extends Seeder
{
    public function run()
    {
        // Create press categories
        $categories = [
            [
                'name' => 'Manufacturing',
                'slug' => 'manufacturing',
                'description' => 'News and articles related to manufacturing industry',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Smart Factory',
                'slug' => 'smart-factory',
                'description' => 'Digital transformation and smart manufacturing coverage',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Innovation',
                'slug' => 'innovation',
                'description' => 'Innovation and technology advancement news',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'Corporate News',
                'slug' => 'corporate-news',
                'description' => 'Company announcements and corporate updates',
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'name' => 'Awards & Recognition',
                'slug' => 'awards-recognition',
                'description' => 'Awards, certifications and industry recognition',
                'sort_order' => 5,
                'is_active' => true
            ]
        ];

        foreach ($categories as $categoryData) {
            PressCategory::create($categoryData);
        }

        // Create sample press articles
        $manufacturingCategory = PressCategory::where('slug', 'manufacturing')->first();
        $smartFactoryCategory = PressCategory::where('slug', 'smart-factory')->first();
        $innovationCategory = PressCategory::where('slug', 'innovation')->first();

        $articles = [
            [
                'category_id' => $manufacturingCategory->id,
                'title' => "Industry's Imperatives For Sustainability in Manufacturing",
                'excerpt' => 'Exploring the critical role of sustainable practices in modern manufacturing and logistics operations.',
                'content' => '<p>The manufacturing industry is at a pivotal moment where sustainability is no longer just an option but a necessity. As Premier Roadlines Limited continues to lead in logistics and transportation, we recognize the importance of implementing sustainable practices across all operations.</p><p>Our commitment to environmental responsibility drives innovation in our transportation solutions, helping clients achieve their sustainability goals while maintaining operational efficiency.</p>',
                'external_url' => null,
                'source' => 'Industry Today',
                'published_date' => Carbon::parse('2024-03-15'),
                'author' => 'Industry Analyst',
                'tags' => ['sustainability', 'manufacturing', 'logistics'],
                'sort_order' => 1,
                'is_featured' => true,
                'is_active' => true
            ],
            [
                'category_id' => $smartFactoryCategory->id,
                'title' => 'Digital Manufacturing Week 2020 – Leading the Way',
                'excerpt' => 'Premier Roadlines participation in digital transformation initiatives for the logistics sector.',
                'content' => '<p>Digital transformation is reshaping the logistics landscape. At Digital Manufacturing Week 2020, Premier Roadlines showcased innovative solutions that integrate technology with traditional transportation methods.</p><p>Our digital initiatives focus on real-time tracking, route optimization, and predictive maintenance to ensure efficient and reliable logistics services.</p>',
                'external_url' => null,
                'source' => 'Manufacturing Weekly',
                'published_date' => Carbon::parse('2024-02-20'),
                'author' => 'Tech Reporter',
                'tags' => ['digital transformation', 'technology', 'logistics'],
                'sort_order' => 2,
                'is_featured' => false,
                'is_active' => true
            ],
            [
                'category_id' => $innovationCategory->id,
                'title' => 'Building Back a Sustainable Manufacturing Sector',
                'excerpt' => 'How innovative logistics solutions contribute to sustainable manufacturing recovery.',
                'content' => '<p>The post-pandemic recovery has highlighted the need for resilient and sustainable manufacturing practices. Premier Roadlines plays a crucial role in this transformation by providing eco-friendly transportation solutions.</p><p>Our specialized services in project transportation and over-dimensional cargo handling support the manufacturing sector\'s recovery while maintaining environmental responsibility.</p>',
                'external_url' => null,
                'source' => 'Green Manufacturing',
                'published_date' => Carbon::parse('2024-01-10'),
                'author' => 'Environmental Correspondent',
                'tags' => ['sustainability', 'recovery', 'innovation'],
                'sort_order' => 3,
                'is_featured' => true,
                'is_active' => true
            ]
        ];

        foreach ($articles as $articleData) {
            PressCoverage::create($articleData);
        }
    }
}
