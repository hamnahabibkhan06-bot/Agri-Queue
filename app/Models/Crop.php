<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    protected $guarded = [];
    protected $casts = ['is_active' => 'boolean'];
    protected $appends = ['image_url'];

    /** Local image matched by crop name (public/images/crops/{name}.jpg|png|webp|svg); never a random hotlink. */
    public function getImageUrlAttribute(): string
    {
        $slug = \Illuminate\Support\Str::slug($this->name);
        foreach (['jpg', 'jpeg', 'png', 'webp', 'svg'] as $ext) {
            if (file_exists(public_path("images/crops/{$slug}.{$ext}"))) {
                return asset("images/crops/{$slug}.{$ext}");
            }
        }
        return asset('images/crops/default.svg');
    }
}
