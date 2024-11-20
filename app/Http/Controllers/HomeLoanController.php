<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHomeLoanRequest;
use App\Http\Requests\UpdateHomeLoanRequest;
use App\Models\HomeLoan;
use App\Models\Client;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeLoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param StoreHomeLoanRequest $request
     * @param Client $client
     * @return RedirectResponse
     */
    public function store(StoreHomeLoanRequest $request, Client $client): RedirectResponse
    {
        $homeLoan = new HomeLoan([
            'property_value' => $request->input('property_value'),
            'down_payment' => $request->input('down_payment'),
        ]);
        $homeLoan->client()->associate($client);
        $homeLoan->adviser()->associate($request->user());
        $homeLoan->save();

        return redirect()->route('clients.edit', $client->id)
            ->with('success', 'Home Loan created successfully');
    }

    /**
     * @param UpdateHomeLoanRequest $request
     * @param Client $client
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateHomeLoanRequest $request, Client $client): RedirectResponse
    {
        $homeLoan = $client->homeLoan;

        $this->authorize('update', $homeLoan);

        $homeLoan->update([
            'property_value' => $request->input('property_value'),
            'down_payment' => $request->input('down_payment'),
        ]);

        return redirect()->route('clients.edit', $client->id)
            ->with('success', 'Home Loan updated successfully');
    }
}
