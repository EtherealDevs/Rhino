<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CascadesDeletes;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use CascadesDeletes;
    use SoftDeletes;
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['name', 'slug', 'description', 'category_id', 'brand_id', 'volume', 'weight'];
    protected $cascadeDeletes = ['items'];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sale(): HasOne
    {
        return $this->hasOne(SaleProduct::class);
    }

    public function combo(): HasOne
    {
        return $this->hasOne(Combo_items::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ProductItem::class);
    }
    public function variations(): HasManyThrough
    {
        return $this->hasManyThrough(ProductSize::class, ProductItem::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
