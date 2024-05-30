<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleProduct extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function sale() : BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function products() : BelongsTo
    {
        return $this->belongsTo(ProductItem::class);
    }
}
