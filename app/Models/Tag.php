<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }

    public static function findOrCreateByName(string $name): self
    {
        $slug = Str::slug($name);
        return static::firstOrCreate(['slug' => $slug], ['name' => $name, 'slug' => $slug]);
    }
}
