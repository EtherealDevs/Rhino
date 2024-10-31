<?php

namespace App\Models;

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
    protected $fillable = ['product_item_id', 'size_id', 'stock'];

}
