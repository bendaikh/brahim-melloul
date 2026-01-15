<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    protected $fillable = [
        'reference', 'oem_reference', 'name', 'slug', 'description', 
        'brand_id', 'category_id', 'purchase_price', 'sale_price', 
        'professional_price', 'stock_quantity', 'min_stock_level', 
        'location', 'specifications', 'is_active'
    ];

    protected $casts = [
        'specifications' => 'json',
        'is_active' => 'boolean',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }
    
    public function documentItems(): HasMany
    {
        return $this->hasMany(DocumentItem::class);
    }
}
