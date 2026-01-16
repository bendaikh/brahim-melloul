<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    protected $fillable = [
        'reference', 
        'code',
        'name', 
        'slug', 
        'description',
        'image',
        'classment',
        'prix_brut',
        'block',
        'diametre',
        'representant_prix',
        'reference_equivalent',
        'designation',
        'category_id', 
        'brand_id',
        'car_logo_id',
        'representant_id',
        'purchase_price', 
        'sale_price', 
        'professional_price', 
        'prix_brut',
        'remise',
        'prix_net',
        'prix_achat',
        'stock_quantity', 
        'min_stock_level', 
        'location', 
        'specifications', 
        'is_active'
    ];

    protected $casts = [
        'specifications' => 'json',
        'designation' => 'array',
        'is_active' => 'boolean',
        'prix_brut' => 'decimal:2',
        'remise' => 'decimal:2',
        'prix_net' => 'decimal:2',
        'prix_achat' => 'decimal:2',
        'representant_prix' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function carLogo(): BelongsTo
    {
        return $this->belongsTo(CarLogo::class);
    }

    public function representant(): BelongsTo
    {
        return $this->belongsTo(Representant::class);
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
