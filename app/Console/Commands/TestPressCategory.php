<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PressCategory;
use Illuminate\Support\Str;

class TestPressCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-press-category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test creating a press category';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $this->info('Testing Press Category creation...');
            
            $data = [
                'name' => 'Test Category',
                'slug' => Str::slug('Test Category'),
                'description' => 'This is a test category',
                'sort_order' => 0,
                'is_active' => true
            ];
            
            $this->info('Data to insert: ' . json_encode($data));
            
            $category = PressCategory::create($data);
            
            $this->info('Category created successfully!');
            $this->info('ID: ' . $category->id);
            $this->info('Name: ' . $category->name);
            $this->info('Slug: ' . $category->slug);
            
        } catch (\Exception $e) {
            $this->error('Error creating category: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}
