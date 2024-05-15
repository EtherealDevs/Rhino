<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
    ];

    public function subCategories() {
        return $this->hasMany(SubCategory::class);
    }

    public function brands() {
        return $this->belongsToMany(Brand::class);
    }

    public function products() {
        return $this->hasManyThrough(Product::class, SubCategory::class);
    }
}
