<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'subtitle',
        'concentration',
        'fragrance_family',
        'price',
        'original_price',
        'rating',
        'reviews_count',
        'badge',
        'size_default',
        'available_sizes',
        'top_notes',
        'heart_notes',
        'base_notes',
        'longevity',
        'sillage',
        'description',
        'image',
        'gallery',
        'stock',
        'is_featured',
        'is_bestseller',
        'is_new',
        'is_active',
    ];

    protected $casts = [
        'available_sizes' => 'array',
        'gallery' => 'array',
        'price' => 'float',
        'original_price' => 'float',
        'rating' => 'float',
        'is_featured' => 'boolean',
        'is_bestseller' => 'boolean',
        'is_new' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedOriginalPriceAttribute(): ?string
    {
        return $this->original_price ? 'Rp ' . number_format($this->original_price, 0, ',', '.') : null;
    }

    public function getDiscountPercentageAttribute(): ?int
    {
        if ($this->original_price && $this->original_price > $this->price) {
            return (int) round((($this->original_price - $this->price) / $this->original_price) * 100);
        }
        return null;
    }
}
