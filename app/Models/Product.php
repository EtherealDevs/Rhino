<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['name', 'slug', 'description', 'category_id', 'brand_id'];

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sale() : HasOne
    {
        return $this->hasOne(SaleProduct::class);
    }

    public function items() : HasMany
    {
        return $this->hasMany(ProductItem::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
