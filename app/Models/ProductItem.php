<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ProductItem extends Model
{

    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['product_id', 'original_price', 'sale_price', 'color_id'];

    public function price() : float
    {
        if ($this->sale_price != null) {
            return $this->sale_price;
        } else
        {
            return $this->original_price;
        }
    }
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function color() : BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
    public function sizes() : BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'products_sizes');
    }
    public function image() : MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function sale() : HasOne
    {
        return $this->hasOne(SaleProduct::class);
    }
    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'product_item_id', 'user_id')->as('favorites')->withTimestamps();
    }
}
