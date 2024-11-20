<?php

namespace App\Policies;

use App\Models\Adviser;
use App\Models\HomeLoan;
use Illuminate\Auth\Access\Response;

class HomeLoanPolicy
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
    public function view(Adviser $adviser, HomeLoan $homeLoan): bool
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
    public function update(Adviser $adviser, HomeLoan $homeLoan): bool
    {
        return $homeLoan->adviser_id === $adviser->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Adviser $adviser, HomeLoan $homeLoan): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Adviser $adviser, HomeLoan $homeLoan): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Adviser $adviser, HomeLoan $homeLoan): bool
    {
        //
    }
}
