<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($product) {
            $product->slug = $product->createSlug($product->name);
            $product->save();
        });

    }

    private function createSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $total = static::whereName($name)->count();
            return "{$slug}-{$total}";
        }
        return $slug;
    }

}
