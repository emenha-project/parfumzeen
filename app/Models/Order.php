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
        // Tracking fields
        'order_status',
        'courier',
        'resi_number',
        'estimated_delivery',
        'tracking_history',
    ];

    protected $casts = [
        'subtotal'           => 'float',
        'shipping_fee'       => 'float',
        'discount_amount'    => 'float',
        'grand_total'        => 'float',
        'paid_at'            => 'datetime',
        'expired_at'         => 'datetime',
        'estimated_delivery' => 'datetime',
        'tracking_history'   => 'array',
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
            'qris'          => 'QRIS (GoPay, OVO, ShopeePay, BCA, Livin, Dana)',
            'bca_va'        => 'BCA Virtual Account',
            'mandiri_va'    => 'Mandiri Virtual Account',
            'bni_va'        => 'BNI Virtual Account',
            'bri_va'        => 'BRI Virtual Account',
            'bank_transfer' => 'Transfer Bank Manual',
            default         => strtoupper($this->payment_method),
        };
    }

    /**
     * Get order status label in Bahasa Indonesia
     */
    public function getOrderStatusLabelAttribute(): string
    {
        return match ($this->order_status) {
            'pending'     => 'Menunggu Pembayaran',
            'confirmed'   => 'Pembayaran Dikonfirmasi',
            'packed'      => 'Sedang Dikemas',
            'shipped'     => 'Pesanan Dikirim',
            'in_transit'  => 'Dalam Pengiriman',
            'delivered'   => 'Pesanan Diterima',
            'cancelled'   => 'Dibatalkan',
            default       => ucfirst($this->order_status),
        };
    }

    /**
     * Get order status badge color (Tailwind)
     */
    public function getOrderStatusColorAttribute(): string
    {
        return match ($this->order_status) {
            'pending'     => 'yellow',
            'confirmed'   => 'blue',
            'packed'      => 'purple',
            'shipped'     => 'indigo',
            'in_transit'  => 'orange',
            'delivered'   => 'green',
            'cancelled'   => 'red',
            default       => 'gray',
        };
    }

    /**
     * Get Shopee-style tracking timeline
     * Returns array of steps with status, label, timestamp, description, done/active state
     */
    public function getTrackingTimelineAttribute(): array
    {
        $statuses = [
            'pending'    => ['icon' => '🕐', 'label' => 'Pesanan Dibuat',          'desc' => 'Pesanan Anda berhasil dibuat, menunggu konfirmasi pembayaran.'],
            'confirmed'  => ['icon' => '✅', 'label' => 'Pembayaran Dikonfirmasi', 'desc' => 'Pembayaran Anda telah dikonfirmasi oleh tim ZEEN Atelier.'],
            'packed'     => ['icon' => '📦', 'label' => 'Sedang Dikemas',          'desc' => 'Pesanan Anda sedang dikemas dengan teliti oleh tim kami.'],
            'shipped'    => ['icon' => '🚚', 'label' => 'Pesanan Dikirim',         'desc' => 'Pesanan telah diserahkan kepada kurir ' . ($this->courier ?? 'ekspedisi') . '.'],
            'in_transit' => ['icon' => '📍', 'label' => 'Dalam Pengiriman',        'desc' => 'Paket sedang dalam perjalanan menuju alamat Anda.'],
            'delivered'  => ['icon' => '🎉', 'label' => 'Pesanan Diterima',        'desc' => 'Paket telah diterima. Terima kasih telah berbelanja di ZEEN Atelier!'],
        ];

        $order = ['pending', 'confirmed', 'packed', 'shipped', 'in_transit', 'delivered'];
        $currentIndex = array_search($this->order_status, $order);
        if ($currentIndex === false) $currentIndex = -1;

        // Build timeline from tracking_history (admin-added events)
        $historyByStatus = [];
        foreach ($this->tracking_history ?? [] as $event) {
            $historyByStatus[$event['status']] = $event;
        }

        $timeline = [];
        foreach ($order as $index => $status) {
            $info = $statuses[$status];
            $isDone   = $index < $currentIndex;
            $isActive = $index === $currentIndex;

            $timestamp = null;
            $customDesc = $info['desc'];

            if (isset($historyByStatus[$status])) {
                $event     = $historyByStatus[$status];
                $timestamp = $event['timestamp'] ?? null;
                $customDesc = $event['note'] ?? $customDesc;
            } elseif ($status === 'pending') {
                $timestamp = $this->created_at?->format('d M Y, H:i') . ' WIB';
            }

            $timeline[] = [
                'status'    => $status,
                'icon'      => $info['icon'],
                'label'     => $info['label'],
                'desc'      => $customDesc,
                'timestamp' => $timestamp,
                'done'      => $isDone,
                'active'    => $isActive,
            ];
        }

        return array_reverse($timeline); // Most recent first (like Shopee)
    }

    /**
     * Add a tracking event to history
     */
    public function addTrackingEvent(string $status, string $note = ''): void
    {
        $history = $this->tracking_history ?? [];
        // Replace existing event for this status or add new
        $found = false;
        foreach ($history as &$event) {
            if ($event['status'] === $status) {
                $event['timestamp'] = now()->format('d M Y, H:i') . ' WIB';
                $event['note']      = $note;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $history[] = [
                'status'    => $status,
                'timestamp' => now()->format('d M Y, H:i') . ' WIB',
                'note'      => $note,
            ];
        }
        $this->tracking_history = $history;
        $this->order_status     = $status;
        $this->save();
    }
}
