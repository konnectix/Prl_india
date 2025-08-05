<?php

namespace Database\Seeders;

use App\Models\VideoCategory;
use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Video Categories
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Technology and innovation videos',
                'color' => '#007bff',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Engineering',
                'slug' => 'engineering',
                'description' => 'Engineering and construction videos',
                'color' => '#28a745',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Manufacturing',
                'slug' => 'manufacturing',
                'description' => 'Manufacturing process videos',
                'color' => '#ffc107',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Corporate',
                'slug' => 'corporate',
                'description' => 'Corporate and company videos',
                'color' => '#dc3545',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            VideoCategory::create($categoryData);
        }

        // Get created categories
        $techCategory = VideoCategory::where('slug', 'technology')->first();
        $engCategory = VideoCategory::where('slug', 'engineering')->first();
        $mfgCategory = VideoCategory::where('slug', 'manufacturing')->first();
        $corpCategory = VideoCategory::where('slug', 'corporate')->first();

        // Create Sample Videos
        $videos = [
            [
                'title' => 'Advanced Manufacturing Techniques',
                'slug' => 'advanced-manufacturing-techniques',
                'description' => 'Explore the latest in advanced manufacturing techniques and technologies that are revolutionizing the industry.',
                'category_id' => $mfgCategory->id,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'youtube_id' => 'dQw4w9WgXcQ',
                'duration' => 300,
                'tags' => ['manufacturing', 'technology', 'innovation'],
                'sort_order' => 1,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Engineering Innovations 2024',
                'slug' => 'engineering-innovations-2024',
                'description' => 'Discover the groundbreaking engineering innovations that are shaping the future of construction and infrastructure.',
                'category_id' => $engCategory->id,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=ScMzIvxBSi4',
                'youtube_id' => 'ScMzIvxBSi4',
                'duration' => 450,
                'tags' => ['engineering', 'innovation', '2024'],
                'sort_order' => 2,
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'title' => 'Smart Technology Integration',
                'slug' => 'smart-technology-integration',
                'description' => 'Learn how smart technology is being integrated into modern industrial processes for enhanced efficiency.',
                'category_id' => $techCategory->id,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=M7lc1UVf-VE',
                'youtube_id' => 'M7lc1UVf-VE',
                'duration' => 360,
                'tags' => ['technology', 'smart', 'integration'],
                'sort_order' => 3,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Company Overview and Vision',
                'slug' => 'company-overview-vision',
                'description' => 'Get to know our company, our vision, and our commitment to excellence in industrial solutions.',
                'category_id' => $corpCategory->id,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=kJQP7kiw5Fk',
                'youtube_id' => 'kJQP7kiw5Fk',
                'duration' => 240,
                'tags' => ['corporate', 'company', 'vision'],
                'sort_order' => 4,
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'title' => 'Sustainable Manufacturing Practices',
                'slug' => 'sustainable-manufacturing-practices',
                'description' => 'Explore our commitment to sustainable manufacturing practices and environmental responsibility.',
                'category_id' => $mfgCategory->id,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=LXb3EKWsInQ',
                'youtube_id' => 'LXb3EKWsInQ',
                'duration' => 420,
                'tags' => ['sustainability', 'manufacturing', 'environment'],
                'sort_order' => 5,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Cutting-Edge Engineering Solutions',
                'slug' => 'cutting-edge-engineering-solutions',
                'description' => 'Discover our cutting-edge engineering solutions that are setting new industry standards.',
                'category_id' => $engCategory->id,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=ZZ5LpwO-An4',
                'youtube_id' => 'ZZ5LpwO-An4',
                'duration' => 380,
                'tags' => ['engineering', 'solutions', 'innovation'],
                'sort_order' => 6,
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($videos as $videoData) {
            Video::create($videoData);
        }
    }
}
