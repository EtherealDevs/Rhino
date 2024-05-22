<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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

    public function parentCategory() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function subCategories() : HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function image() : MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
}
