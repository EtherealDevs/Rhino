<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Combo extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['discount'];

    public function items() : HasMany
    {
        return $this->hasMany(Combo_items::class);
    }
    public function totalPrice()
    {
        $items = $this->items;
        $totalPrice = 0;
        foreach ($items as $item) {
            $itemPrice = $item->item->original_price;
            $totalPrice += $itemPrice;
        }
        return ($totalPrice * (1 - $this->discount / 100));
    }
    public function getMaximumAddableAmount()
    {
        $items = $this->items;
        $stocks = [];
        foreach ($items as $item) {
            $itemStock = $item->item->getMinStock();
            array_push($stocks, $itemStock);
        }
        return min($stocks);
    }
    public function getItemsSizesByMinimumStockValue()
    {
        $items = $this->items;
        $sizesByMinStockValue = [];
        foreach ($items as $item) {
            $id = $item->item->id;
            $itemStock = $item->item->getMinStock();
            $itemSizes = $item->item->sizes;
            foreach ($itemSizes as $size) {
                if ($size->pivot->stock == $itemStock) {
                    $sizesByMinStockValue["$id"] = $size->name;
                }
            }
        }
        return $sizesByMinStockValue;
    }
}
