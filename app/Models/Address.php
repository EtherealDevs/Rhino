<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['user_id', 'street', 'number', 'zip_code', 'observation'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
