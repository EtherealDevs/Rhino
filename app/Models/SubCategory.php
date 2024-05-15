<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
