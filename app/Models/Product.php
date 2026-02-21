<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

  protected $fillable = [
    'name',
    'description',
    'image',
    'image_2',
    'image_3',
    'color_name',
    'color_hex',
    'color_variants',
    'category',
    'type',
    'gender',
    'price',
    'on_sale',
    'sale_price',
    'is_new',
    'is_featured',
    'sales_count',
    'sizes',
];
    protected $casts = [
    'is_new'         => 'boolean',
    'is_featured'    => 'boolean',
    'on_sale'        => 'boolean',
    'price'          => 'decimal:2',
    'sale_price'     => 'decimal:2',
    'sizes'          => 'array',
    'color_variants' => 'array',
    'sales_count'    => 'integer',
];
    /**
     * Accessors
     */

    // Image URL for blade
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/placeholder.png');
    }

    // Available sizes (in stock)
    public function getAvailableSizesAttribute()
    {
        if (!$this->sizes) {
            return [];
        }
        return array_keys(array_filter($this->sizes, fn($qty) => $qty > 0));
    }

    // Out of stock sizes
    public function getOutOfStockSizesAttribute()
    {
        if (!$this->sizes) {
            return [];
        }
        return array_keys(array_filter($this->sizes, fn($qty) => $qty <= 0));
    }

    // Is in stock (any size)
    public function getIsInStockAttribute()
    {
        return count($this->available_sizes) > 0;
    }

    /**
     * Check if a specific size is in stock
     */
    public function hasSizeInStock($size)
    {
        return isset($this->sizes[$size]) && $this->sizes[$size] > 0;
    }

    /**
     * Display price (sale price if on sale)
     */
    public function getDisplayPriceAttribute()
    {
        return $this->on_sale && $this->sale_price ? $this->sale_price : $this->price;
    }

    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    public function getFormattedSalePriceAttribute()
    {
        return $this->sale_price ? '$' . number_format($this->sale_price, 2) : null;
    }

    public function getDiscountPercentageAttribute()
    {
        if (!$this->on_sale || !$this->sale_price || !$this->price) return null;
        return round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    /**
     * Label helpers
     */
    public function getTypeLabelAttribute()
    {
        return ucfirst($this->type);
    }

    public function getGenderLabelAttribute()
    {
        return ucfirst($this->gender);
    }

    /**
     * Stock manipulation
     */
    public function incrementSales()
    {
        return $this->increment('sales_count');
    }

    public function decrementStock($size, $quantity = 1)
    {
        if (!$this->sizes || !isset($this->sizes[$size])) return false;
        $sizes = $this->sizes;
        $sizes[$size] = max(0, $sizes[$size] - $quantity);
        return $this->update(['sizes' => $sizes]);
    }

    /**
     * Query Scopes
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOfCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeForGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeNewArrivals($query)
    {
        return $query->where('is_new', true);
    }

    public function scopeOnSale($query)
    {
        return $query->where('on_sale', true);
    }

    public function scopeBestSelling($query)
    {
        return $query->orderBy('sales_count', 'desc');
    }

    public function scopePriceLowToHigh($query)
    {
        return $query->orderBy('price', 'asc');
    }

    public function scopePriceHighToLow($query)
    {
        return $query->orderBy('price', 'desc');
    }

    public function scopeAlphabetically($query, $direction = 'asc')
    {
        return $query->orderBy('name', $direction);
    }
}