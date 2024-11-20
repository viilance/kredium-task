<?php

namespace App\Policies;

use App\Models\Adviser;
use App\Models\Client;
use Illuminate\Auth\Access\Response;

class ClientPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Adviser $adviser): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Adviser $adviser, Client $client): bool
    {
        return $client->adviser_id === $adviser->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Adviser $adviser): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Adviser $adviser, Client $client): bool
    {
        return $client->adviser_id === $adviser->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Adviser $adviser, Client $client): bool
    {
        return $client->adviser_id === $adviser->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Adviser $adviser, Client $client): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Adviser $adviser, Client $client): bool
    {
        //
    }
}
