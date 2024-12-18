<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['user_id', 'payment_method_id', 'total', 'delivery_service_id', 'delivery_price', 'send_number', 'address_id', 'order_status_id', 'mp_order_id'];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function deliveryService()
    {
        return $this->belongsTo(DeliveryService::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }
    public function comprobante(): HasOne{
        return $this->hasOne(Comprobante::class);
    }
}
