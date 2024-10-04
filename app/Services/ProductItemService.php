<?php

namespace App\Services;

use App\Models\ProductItem;
use App\Models\Size;
use Illuminate\Support\Facades\DB;

class ProductItemService
{
    /**
     * Get the item variation based on the provided item and size.
     *
     * @param ProductItem $item The product item model.
     * @param int|string $size The size of the item. Can be an integer (size ID) or a string (size name).
     * @return \Illuminate\Database\Eloquent\Model|object|null The pivot table record for the item variation.
     */
    public function getItemVariation(ProductItem $item, int|string $size)
    {
        if (is_numeric($size)) {
            $pivotTable = DB::table('products_sizes')->where('product_item_id', $item->id)->where('size_id', $size);
        } else if (is_string($size)) {
            $size = Size::where('name', $size)->first();
            $pivotTable = DB::table('products_sizes')->where('product_item_id', $item->id)->where('size_id', $size->id);
        }
        $itemVariation = $pivotTable->first();
        return $itemVariation;
    }
}
