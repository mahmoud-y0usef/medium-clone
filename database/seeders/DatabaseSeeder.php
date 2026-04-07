<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $categories = [
            'Technology',
            'Health',
            'Travel',
            'Food',
            'Lifestyle',
            'Education',
            'Finance',
            'Entertainment',
            'Sports',
            'Fashion',
        ];
        
        foreach ($categories as $categoryName) {
            Category::create(['name' => $categoryName]);
            
        }
        
        User::factory(10)->create();
        Post::factory(100)->create();

       
    }
}
