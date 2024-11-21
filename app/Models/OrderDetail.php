<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Facades\DB;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'variation_id', 'amount', 'price'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function productItem()
    {
        $variation = DB::table('products_sizes')->find($this->variation_id);
        $item = ProductItem::withTrashed()->find($variation->product_item_id);
        return $item;
    }

    public function itemVariation()
    {
        $variation = DB::table('products_sizes')->find($this->variation_id);
        return ProductSize::find($this->variation_id);
    }

    public function alternativeItemRelation(): HasOneThrough
    {
        return $this->hasOneThrough(
            ProductItem::class,      // Modelo final
            ProductSize::class,      // Modelo intermedio
            'id',                    // Llave primaria de ProductSize
            'id',                    // Llave primaria de ProductItem
            'variation_id',          // Llave foránea en OrderDetail que apunta a ProductSize
            'product_item_id'        // Llave foránea en ProductSize que apunta a ProductItem
        );
    }
}
