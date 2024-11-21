<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['user_id', 'name', 'last_name', 'phone_number', 'zip_code_id', 'province_id', 'city_id', 'address', 'street', 'number', 'department', 'street1', 'street2', 'observation'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function zipCode(): BelongsTo
    {
        return $this->belongsTo(ZipCode::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
