<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    /**
     * Get all of the zipCodes for the Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function zipCodes(): HasMany
    {
        return $this->hasMany(ZipCode::class);
    }
    /**
     * Get all of the cities for the Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
    /**
     * Get all of the addresses for the Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
