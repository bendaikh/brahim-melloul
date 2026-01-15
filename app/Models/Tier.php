<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tier extends Model
{
    protected $fillable = [
        'code', 'type', 'name', 'email', 'phone', 'address', 
        'tax_id', 'credit_limit', 'current_balance', 'is_active'
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
