<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Representant extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address', 'commission_rate', 'is_active'];

    protected $casts = [
        'commission_rate' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
