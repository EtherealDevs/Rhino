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
use Illuminate\Support\Collection;

class ProductItem extends Model
{

    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['product_id', 'original_price', 'sale_price', 'color_id'];

    public function price() : int
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
    public function category()
    {
        return $this->product->category;
    }
    public function color() : BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
    public function colors() : Collection
    {
        $colors = collect([]);
        foreach ($this->product->items as $key => $item) {
            $colors->add($item->color);
        }
        return $colors;
    }
    public function sizes() : BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'products_sizes')->withPivot('stock', 'id');
    }
    public function images() : MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'product_item_id', 'user_id')->as('favorites')->withTimestamps();
    }

    public function sale_price():float {
        $discount = $this->product->sale->sale->discount;
        $price= $this->price() - ($this->price() * ($discount/100));
        return $price ;
    }
}
