<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable(); // e.g. "Warm Woods & Smoked Vanilla"
            $table->string('concentration')->default('Extrait de Parfum'); // Extrait de Parfum, Eau de Parfum
            $table->string('fragrance_family')->default('Woody'); // Woody, Gourmand, Floral, Fresh, Oriental
            $table->decimal('price', 12, 2);
            $table->decimal('original_price', 12, 2)->nullable();
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->integer('reviews_count')->default(24);
            $table->string('badge')->nullable(); // BESTSELLER, NEW, EXCLUSIVE, LIMITED
            $table->string('size_default')->default('50ml');
            $table->json('available_sizes')->nullable(); // ['30ml', '50ml', '100ml']
            $table->string('top_notes')->nullable();
            $table->string('heart_notes')->nullable();
            $table->string('base_notes')->nullable();
            $table->string('longevity')->default('12 - 16 Jam');
            $table->string('sillage')->default('Intense & Radiating');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->integer('stock')->default(50);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_bestseller')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
