<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ProductItem extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['product_id', 'original_price', 'sale_price', 'color_id', 'size_id', 'stock'];

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function color() : BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
    public function size() : BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
    public function images() : MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
