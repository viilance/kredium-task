<?php

namespace App\Policies;

use App\Models\Adviser;
use App\Models\CashLoan;
use Illuminate\Auth\Access\Response;

class CashLoanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Adviser $adviser): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Adviser $adviser, CashLoan $cashLoan): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Adviser $adviser): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Adviser $adviser, CashLoan $cashLoan): bool
    {
        return $cashLoan->adviser_id === $adviser->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Adviser $adviser, CashLoan $cashLoan): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Adviser $adviser, CashLoan $cashLoan): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Adviser $adviser, CashLoan $cashLoan): bool
    {
        //
    }
}
