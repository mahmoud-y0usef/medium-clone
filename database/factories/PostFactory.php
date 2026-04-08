<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();
        $slug = str()->slug($title);
        $content = fake()->paragraphs(5, true);
        $image = 'https://flowbite.com/docs/images/blog/image-1.jpg';
        $category_id = Category::inRandomOrder()->first()->id;
        $user_id = \App\Models\User::inRandomOrder()->first()?->id ?? 1;
        $published_at = fake()->optional()->dateTime();
        return [
            'title'=> $title,
            'slug'=> $slug,
            'image'=> $image,
            'content'=> $content,
            'category_id'=> $category_id,
            'user_id'=> $user_id,
            'published_at'=> $published_at,

        ];
    }
}
