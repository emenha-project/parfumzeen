<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'customer_city',
        'customer_province',
        'customer_postal_code',
        'customer_notes',
        'subtotal',
        'shipping_fee',
        'discount_amount',
        'grand_total',
        'payment_method',
        'payment_status',
        'payment_reference',
        'payment_proof',
        'paid_at',
        'expired_at',
    ];

    protected $casts = [
        'subtotal' => 'float',
        'shipping_fee' => 'float',
        'discount_amount' => 'float',
        'grand_total' => 'float',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->grand_total, 0, ',', '.');
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return match ($this->payment_method) {
            'qris' => 'QRIS (GoPay, OVO, ShopeePay, BCA, Livin, Dana)',
            'bca_va' => 'BCA Virtual Account',
            'mandiri_va' => 'Mandiri Virtual Account',
            'bni_va' => 'BNI Virtual Account',
            'bri_va' => 'BRI Virtual Account',
            'bank_transfer' => 'Transfer Bank Manual',
            default => strtoupper($this->payment_method),
        };
    }
}

