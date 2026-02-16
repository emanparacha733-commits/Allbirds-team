<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'color_name',
        'color_hex',
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

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_new' => 'boolean',
        'is_featured' => 'boolean',
        'on_sale' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'sizes' => 'array',
        'sales_count' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS (Getters)
    |--------------------------------------------------------------------------
    */

    /**
     * Get the display price (sale price if on sale, regular price otherwise)
     */
    public function getDisplayPriceAttribute()
    {
        return $this->on_sale && $this->sale_price ? $this->sale_price : $this->price;
    }

    /**
     * Get formatted regular price
     */
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    /**
     * Get formatted sale price
     */
    public function getFormattedSalePriceAttribute()
    {
        return $this->sale_price ? '$' . number_format($this->sale_price, 2) : null;
    }

    /**
     * Get discount percentage
     */
    public function getDiscountPercentageAttribute()
    {
        if (!$this->on_sale || !$this->sale_price || !$this->price) {
            return null;
        }

        return round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    /**
     * Get available sizes
     */
    public function getAvailableSizesAttribute()
    {
        if (!$this->sizes) {
            return [];
        }

        return array_keys(array_filter($this->sizes, function($stock) {
            return $stock > 0;
        }));
    }

    /**
     * Get out of stock sizes
     */
    public function getOutOfStockSizesAttribute()
    {
        if (!$this->sizes) {
            return [];
        }

        return array_keys(array_filter($this->sizes, function($stock) {
            return $stock <= 0;
        }));
    }

    /**
     * Check if product is in stock
     */
    public function getIsInStockAttribute()
    {
        if (!$this->sizes) {
            return true;
        }

        return count($this->available_sizes) > 0;
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }

    /**
     * Get product type label
     */
    public function getTypeLabelAttribute()
    {
        return ucfirst($this->type);
    }

    /**
     * Get product gender label
     */
    public function getGenderLabelAttribute()
    {
        return ucfirst($this->gender);
    }

    /*
    |--------------------------------------------------------------------------
    | METHODS
    |--------------------------------------------------------------------------
    */

    /**
     * Check if product has a specific size in stock
     */
    public function hasSizeInStock($size)
    {
        if (!$this->sizes) {
            return true;
        }

        return isset($this->sizes[$size]) && $this->sizes[$size] > 0;
    }

    /**
     * Increment sales count
     */
    public function incrementSales()
    {
        return $this->increment('sales_count');
    }

    /**
     * Decrement size stock
     */
    public function decrementStock($size, $quantity = 1)
    {
        if (!$this->sizes || !isset($this->sizes[$size])) {
            return false;
        }

        $sizes = $this->sizes;
        $sizes[$size] = max(0, $sizes[$size] - $quantity);
        
        return $this->update(['sizes' => $sizes]);
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * Scope: Filter by type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope: Filter by category
     */
    public function scopeOfCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope: Filter by gender
     */
    public function scopeForGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    /**
     * Scope: Featured products only
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: New arrivals only
     */
    public function scopeNewArrivals($query)
    {
        return $query->where('is_new', true);
    }

    /**
     * Scope: On sale products only
     */
    public function scopeOnSale($query)
    {
        return $query->where('on_sale', true);
    }

    /**
     * Scope: Sort by best selling
     */
    public function scopeBestSelling($query)
    {
        return $query->orderBy('sales_count', 'desc');
    }

    /**
     * Scope: Sort by price (low to high)
     */
    public function scopePriceLowToHigh($query)
    {
        return $query->orderBy('price', 'asc');
    }

    /**
     * Scope: Sort by price (high to low)
     */
    public function scopePriceHighToLow($query)
    {
        return $query->orderBy('price', 'desc');
    }

    /**
     * Scope: Sort alphabetically
     */
    public function scopeAlphabetically($query, $direction = 'asc')
    {
        return $query->orderBy('name', $direction);
    }
}