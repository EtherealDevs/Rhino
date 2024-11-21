<?php

namespace App\Models;

use App\Traits\CascadesDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;


class ProductItem extends Model
{
    use CascadesDeletes;
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['product_id', 'original_price', 'sale_price', 'color_id'];
    protected $cascadeDeletes = ['sizes'];

    public function price(): int
    {
        if (optional($this->product)->sale && optional($this->product->sale)->sale && optional($this->product->sale->sale)->discount) {
            $price = $this->original_price * ($this->product->sale->sale->discount / 100);
            $price = $this->original_price - $price;
            return $price;
        } else {
            return $this->original_price;
        }
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function category()
    {
        return $this->product->category;
    }
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
    public function colors(): Collection
    {
        $colors = collect([]);
        foreach ($this->product->items as $key => $item) {
            $colors->add($item->color);
        }
        return $colors;
    }
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'products_sizes')->using(ProductSize::class)->withPivot('id', 'stock', 'created_at', 'updated_at', 'deleted_at');
    }
    public function getTotalStock()
    {
        $total = 0;
        foreach ($this->sizes as $key => $size) {
            $total += $size->pivot->stock;
        }
        return $total;
    }
    public function getMinStock()
    {
        return $this->sizes->pluck('pivot.stock')->min();
    }

    public function getItemPivotModel($size)
    {
        if (is_string($size)) {
            $size_id = Size::where('name', $size)->first()->getKey();
            return $this->sizes()->wherePivot('size_id', $size_id)->first()->pivot;
        } else if (is_numeric($size)) {
            $size_id = Size::where('name', $size)->first()->id;
            return $this->sizes()->wherePivot('size_id', $size_id)->first()->pivot;
        }
        return $this->sizes()->wherePivot('size_id', $size->id)->first()->pivot;
    }

    public static function getAvailable()
    {
        $productItems = ProductItem::with('sizes')->orderBy('created_at', 'desc')->get();
        $productItems = $productItems->filter(function ($item, $key) {
            foreach ($item->sizes as $sizeKey => $size) {
                if ($size->pivot->deleted_at == null && $size->pivot->stock > 0) {
                    return true;
                }
            }
        });
        return $productItems->toQuery();
    }
    public static function getLatest($number)
    {
        $test = ProductItem::with('product', 'product.category', 'images', 'sizes')->latest()->get();
        $test = $test->filter(function ($item, $key) use ($number) {
            foreach ($item->sizes as $sizeKey => $size) {
                if ($size->pivot->deleted_at == null) {
                    return true;
                }
            }
        });
        dd($test->take(3));
    }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'product_item_id', 'user_id')->as('favorites')->withTimestamps();
    }

    public function sale_price(): float
    {
        $discount = $this->product->sale->sale->discount;
        $price = $this->price() - ($this->price() * ($discount / 100));
        return $price;
    }
    public function combo(): HasOne
    {
        return $this->hasOne(Combo_items::class);
    }
}
