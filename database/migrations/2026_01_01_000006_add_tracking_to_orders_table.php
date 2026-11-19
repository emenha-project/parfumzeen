<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Order fulfillment status (separate from payment_status)
            $table->string('order_status')->default('pending')->after('payment_proof');
            // Shipping info
            $table->string('courier')->nullable()->after('order_status');
            $table->string('resi_number')->nullable()->after('courier');
            $table->timestamp('estimated_delivery')->nullable()->after('resi_number');
            // Tracking history as JSON array of events
            $table->json('tracking_history')->nullable()->after('estimated_delivery');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['order_status', 'courier', 'resi_number', 'estimated_delivery', 'tracking_history']);
        });
    }
};
