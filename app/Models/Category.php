<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
    ];

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function items(): HasManyThrough
    {
        return $this->hasManyThrough(ProductItem::class, Product::class);
    }
    // En tu modelo Category.php
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public static function hierarchicalCategories($parentId = null)
    {
        return self::where('parent_id', $parentId)
            ->with('children.children') // Carga las categorías hijas y nietas
            ->get();
    }
}
