<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GalleryCategory;
use App\Models\GalleryPhoto;
use App\Models\PressCategory;
use App\Models\PressCoverage;
use App\Models\ContactInfo;
use App\Models\ContactLocation;

class TestCrudOperations extends Command
{
    protected $signature = 'test:crud';
    protected $description = 'Test CRUD operations for all models';

    public function handle()
    {
        $this->info('Testing CRUD operations for all models...');
        
        // Test GalleryCategory
        $this->testGalleryCategory();
        
        // Test GalleryPhoto
        $this->testGalleryPhoto();
        
        // Test PressCategory
        $this->testPressCategory();
        
        // Test PressCoverage
        $this->testPressCoverage();
        
        // Test ContactInfo
        $this->testContactInfo();
        
        // Test ContactLocation
        $this->testContactLocation();
        
        $this->info('All CRUD tests completed successfully!');
    }
    
    private function testGalleryCategory()
    {
        $this->info('Testing GalleryCategory...');
        
        // Create
        $category = GalleryCategory::create([
            'name' => 'Test Category',
            'description' => 'Test Description',
            'sort_order' => 1,
            'is_active' => true
        ]);
        $this->line("✓ Created category: {$category->name}");
        
        // Read
        $found = GalleryCategory::find($category->id);
        $this->line("✓ Found category: {$found->name}");
        
        // Update
        $category->update(['name' => 'Updated Test Category']);
        $this->line("✓ Updated category: {$category->fresh()->name}");
        
        // Delete
        $category->delete();
        $this->line("✓ Deleted category");
        
        $this->info('GalleryCategory CRUD test passed!');
    }
    
    private function testGalleryPhoto()
    {
        $this->info('Testing GalleryPhoto...');
        
        // Create a category first
        $category = GalleryCategory::create([
            'name' => 'Test Photo Category',
            'description' => 'Test Description',
            'sort_order' => 1,
            'is_active' => true
        ]);
        
        // Create
        $photo = GalleryPhoto::create([
            'category_id' => $category->id,
            'title' => 'Test Photo',
            'description' => 'Test Photo Description',
            'image_url' => 'https://example.com/test.jpg',
            'alt_text' => 'Test Alt Text',
            'sort_order' => 1,
            'is_active' => true
        ]);
        $this->line("✓ Created photo: {$photo->title}");
        
        // Read
        $found = GalleryPhoto::with('category')->find($photo->id);
        $this->line("✓ Found photo: {$found->title} in category: {$found->category->name}");
        
        // Update
        $photo->update(['title' => 'Updated Test Photo']);
        $this->line("✓ Updated photo: {$photo->fresh()->title}");
        
        // Delete
        $photo->delete();
        $category->delete();
        $this->line("✓ Deleted photo and category");
        
        $this->info('GalleryPhoto CRUD test passed!');
    }
    
    private function testPressCategory()
    {
        $this->info('Testing PressCategory...');
        
        // Create
        $category = PressCategory::create([
            'name' => 'Test Press Category',
            'description' => 'Test Description',
            'sort_order' => 1,
            'is_active' => true
        ]);
        $this->line("✓ Created press category: {$category->name}");
        
        // Read
        $found = PressCategory::find($category->id);
        $this->line("✓ Found press category: {$found->name}");
        
        // Update
        $category->update(['name' => 'Updated Test Press Category']);
        $this->line("✓ Updated press category: {$category->fresh()->name}");
        
        // Delete
        $category->delete();
        $this->line("✓ Deleted press category");
        
        $this->info('PressCategory CRUD test passed!');
    }
    
    private function testPressCoverage()
    {
        $this->info('Testing PressCoverage...');
        
        // Create a category first
        $category = PressCategory::create([
            'name' => 'Test Press Coverage Category',
            'description' => 'Test Description',
            'sort_order' => 1,
            'is_active' => true
        ]);
        
        // Create
        $coverage = PressCoverage::create([
            'category_id' => $category->id,
            'title' => 'Test Press Coverage',
            'excerpt' => 'Test Excerpt',
            'content' => 'Test Content',
            'source' => 'Test Source',
            'published_date' => now(),
            'author' => 'Test Author',
            'tags' => ['test', 'coverage'],
            'sort_order' => 1,
            'is_featured' => false,
            'is_active' => true
        ]);
        $this->line("✓ Created press coverage: {$coverage->title}");
        
        // Read
        $found = PressCoverage::with('category')->find($coverage->id);
        $this->line("✓ Found press coverage: {$found->title} in category: {$found->category->name}");
        
        // Update
        $coverage->update(['title' => 'Updated Test Press Coverage']);
        $this->line("✓ Updated press coverage: {$coverage->fresh()->title}");
        
        // Delete
        $coverage->delete();
        $category->delete();
        $this->line("✓ Deleted press coverage and category");
        
        $this->info('PressCoverage CRUD test passed!');
    }
    
    private function testContactInfo()
    {
        $this->info('Testing ContactInfo...');
        
        // Create
        $info = ContactInfo::create([
            'key' => 'test_contact_info',
            'label' => 'Test Contact Info',
            'value' => 'Test Value',
            'type' => 'text',
            'icon' => 'fas fa-test',
            'section' => 'general',
            'sort_order' => 1,
            'is_active' => true
        ]);
        $this->line("✓ Created contact info: {$info->label}");
        
        // Read
        $found = ContactInfo::find($info->id);
        $this->line("✓ Found contact info: {$found->label}");
        
        // Update
        $info->update(['label' => 'Updated Test Contact Info']);
        $this->line("✓ Updated contact info: {$info->fresh()->label}");
        
        // Delete
        $info->delete();
        $this->line("✓ Deleted contact info");
        
        $this->info('ContactInfo CRUD test passed!');
    }
    
    private function testContactLocation()
    {
        $this->info('Testing ContactLocation...');
        
        // Create
        $location = ContactLocation::create([
            'name' => 'Test Location',
            'address' => 'Test Address',
            'phone' => '+1234567890',
            'email' => 'test@example.com',
            'weekday_hours' => '9 AM - 6 PM',
            'weekend_hours' => '10 AM - 4 PM',
            'sort_order' => 1,
            'is_active' => true,
            'is_default' => false
        ]);
        $this->line("✓ Created contact location: {$location->name}");
        
        // Read
        $found = ContactLocation::find($location->id);
        $this->line("✓ Found contact location: {$found->name}");
        
        // Update
        $location->update(['name' => 'Updated Test Location']);
        $this->line("✓ Updated contact location: {$location->fresh()->name}");
        
        // Delete
        $location->delete();
        $this->line("✓ Deleted contact location");
        
        $this->info('ContactLocation CRUD test passed!');
    }
}
