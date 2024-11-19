<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone'
    ];

    public function cashLoan(): HasOne
    {
        return $this->hasOne(CashLoan::class);
    }

    public function homeLoan(): HasOne
    {
        return $this->hasOne(HomeLoan::class);
    }
}
