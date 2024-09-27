<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferInfo extends Model
{
    use HasFactory;

    protected $fillable = ['alias', 'cbu', 'holder_name'];
}
