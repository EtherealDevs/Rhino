<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Sale extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function images() : MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function products() : HasMany
    {
        return $this->hasMany(SaleProduct::class);
    }
}
