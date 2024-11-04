<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Pivot
{
    use SoftDeletes;
    /**
 * Indicates if the IDs are auto-incrementing.
 *
 * @var bool
 */
    public $incrementing = true;
    protected $table = 'products_sizes';
    protected $fillable = ['product_item_id', 'size_id', 'stock'];

    public function size() : BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
    public function item() : BelongsTo
    {
        return $this->belongsTo(ProductItem::class, 'product_item_id');
    }
    public function product()
    {
        return $this->item->product;
    }
}
