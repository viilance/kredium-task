<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashLoan extends Model
{
    protected $fillable = [
        'client_id',
        'adviser_id',
        'loan_amount'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function adviser(): BelongsTo
    {
        return $this->belongsTo(Adviser::class);
    }
}
