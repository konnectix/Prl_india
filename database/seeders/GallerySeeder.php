<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use App\Models\GalleryPhoto;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run()
    {
        // Create gallery categories based on the provided HTML
        $categories = [
            [
                'name' => 'Projects executed',
                'slug' => 'projects-executed',
                'description' => 'Gallery of completed transportation and logistics projects',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'name' => '2024 IPO Listing',
                'slug' => '2024-ipo-listing',
                'description' => 'Photos from Premier Roadlines IPO listing event in 2024',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'name' => '2024 IPO Celebration',
                'slug' => '2024-ipo-celebration',
                'description' => 'Celebration moments from the successful IPO listing',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'name' => '2024 Khatu Shyam Ji Kirtan',
                'slug' => '2024-khatu-shyam-ji-kirtan',
                'description' => 'Religious ceremony and kirtan event photos',
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'name' => '2024 Meeting',
                'slug' => '2024-meeting',
                'description' => 'Corporate meetings and business events from 2024',
                'sort_order' => 5,
                'is_active' => true
            ],
            [
                'name' => '2023 AGM',
                'slug' => '2023-agm',
                'description' => 'Annual General Meeting photos from 2023',
                'sort_order' => 6,
                'is_active' => true
            ],
            [
                'name' => '2023 Meeting',
                'slug' => '2023-meeting',
                'description' => 'Corporate meetings and events from 2023',
                'sort_order' => 7,
                'is_active' => true
            ],
            [
                'name' => 'New Office Inauguration',
                'slug' => 'new-office-inauguration',
                'description' => 'Photos from new office opening ceremony',
                'sort_order' => 8,
                'is_active' => true
            ],
            [
                'name' => '2019 AGM',
                'slug' => '2019-agm',
                'description' => 'Annual General Meeting photos from 2019',
                'sort_order' => 9,
                'is_active' => true
            ]
        ];

        foreach ($categories as $categoryData) {
            GalleryCategory::create($categoryData);
        }

        // Add some sample photos to the "Projects executed" category
        $projectsCategory = GalleryCategory::where('slug', 'projects-executed')->first();
        
        if ($projectsCategory) {
            $samplePhotos = [
                [
                    'category_id' => $projectsCategory->id,
                    'title' => 'Heavy Machinery Transportation',
                    'description' => 'Successful transportation of heavy industrial machinery across state borders',
                    'image_url' => 'https://prlindia.com/wp-content/uploads/2024/07/WhatsApp-Image-2024-07-26-at-5.58.13-PM-2.jpeg',
                    'alt_text' => 'Heavy machinery being transported on specialized trailer',
                    'sort_order' => 1,
                    'is_active' => true
                ],
                [
                    'category_id' => $projectsCategory->id,
                    'title' => 'Over Dimensional Cargo',
                    'description' => 'ODC transportation project showcasing our specialized handling capabilities',
                    'image_url' => 'https://prlindia.com/wp-content/uploads/2024/07/WhatsApp-Image-2024-07-26-at-5.58.13-PM-3.jpeg',
                    'alt_text' => 'Over dimensional cargo being transported',
                    'sort_order' => 2,
                    'is_active' => true
                ],
                [
                    'category_id' => $projectsCategory->id,
                    'title' => 'Project Logistics Solution',
                    'description' => 'Complete end-to-end logistics solution for industrial project',
                    'image_url' => 'https://prlindia.com/wp-content/uploads/2024/07/WhatsApp-Image-2024-07-26-at-5.58.13-PM-4.jpeg',
                    'alt_text' => 'Logistics team coordinating project transportation',
                    'sort_order' => 3,
                    'is_active' => true
                ],
                [
                    'category_id' => $projectsCategory->id,
                    'title' => 'Multi-Modal Transportation',
                    'description' => 'Integration of road, rail and waterway transportation modes',
                    'image_url' => 'https://prlindia.com/wp-content/uploads/2024/07/WhatsApp-Image-2024-07-26-at-5.58.13-PM-5.jpeg',
                    'alt_text' => 'Multi-modal transportation coordination',
                    'sort_order' => 4,
                    'is_active' => true
                ],
                [
                    'category_id' => $projectsCategory->id,
                    'title' => 'Crane and Rigging Operations',
                    'description' => 'Specialized crane operations for heavy lifting requirements',
                    'image_url' => 'https://prlindia.com/wp-content/uploads/2024/07/WhatsApp-Image-2024-07-26-at-5.58.13-PM-6.jpeg',
                    'alt_text' => 'Crane operations in progress',
                    'sort_order' => 5,
                    'is_active' => true
                ]
            ];

            foreach ($samplePhotos as $photoData) {
                GalleryPhoto::create($photoData);
            }
        }
    }
}
