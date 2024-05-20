<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function categories() : HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function brands() {
        return $this->belongsToMany(Brand::class);
    }
    public function image(){
        return $this->morphMany(Image::class, 'imageable');
    }
}
