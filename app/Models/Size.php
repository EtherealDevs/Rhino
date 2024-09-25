<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function items() : BelongsToMany
    {
        return $this->belongsToMany(ProductItem::class, 'products_sizes')->using(ProductSize::class)->withPivot('stock', 'id');
    }



}
