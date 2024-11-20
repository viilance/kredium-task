<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'adviser_id',
    ];

    public function cashLoan(): HasOne
    {
        return $this->hasOne(CashLoan::class);
    }

    public function homeLoan(): HasOne
    {
        return $this->hasOne(HomeLoan::class);
    }

    public function adviser(): BelongsTo
    {
        return $this->belongsTo(Adviser::class);
    }
}
