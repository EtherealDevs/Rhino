<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'variation_id', 'amount', 'price'];

    /**
     * Get the order that owns the OrderDetail.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product item associated with the OrderDetail.
     */
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
}
