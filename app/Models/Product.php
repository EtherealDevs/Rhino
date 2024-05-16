<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function sizes() {
        return $this->hasMany(Size::class);
    }
    
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function colors() {
        return $this->hasMany(Color::class);
    }

    public function items() : HasMany
    {
        return $this->hasMany(ProductItem::class);
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
}
