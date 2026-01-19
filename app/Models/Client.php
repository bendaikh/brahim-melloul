<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    protected $fillable = [
        'nom_client',
        'numero_client',
        'telephone',
        'ville',
        'region',
        'representant_id',
        'ice',
        'address',
    ];

    public function representant(): BelongsTo
    {
        return $this->belongsTo(Representant::class);
    }
}
