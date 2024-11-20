<?php

namespace App\Http\Controllers;

use App\Models\HomeLoan;
use App\Models\Client;
use Illuminate\Http\Request;

class HomeLoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $clientId)
    {
        $client = Client::findOrFail($clientId);

        if ($client->adviser_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'property_value' => 'required|numeric|min:0',
            'down_payment' => 'required|numeric|min:0',
        ]);

        if ($client->homeLoan) {
            return back()->withErrors(['loan' => 'This client already has a Home Loan.'])->withInput();
        }

        HomeLoan::create([
            'client_id' => $client->id,
            'adviser_id' => auth()->id(),
            'property_value' => $request->input('property_value'),
            'down_payment' => $request->input('down_payment'),
        ]);

        return redirect()->route('clients.edit', $client->id)->with('success', 'Home Loan created successfully');
    }

    public function update(Request $request, $clientId)
    {
        $client = Client::findOrFail($clientId);

        if ($client->adviser_id !== auth()->id()) {
            abort(403);
        }

        $homeLoan = $client->homeLoan;

        if (!$homeLoan) {
            return back()->withErrors(['loan' => 'No Home Loan found for this client.'])->withInput();
        }

        $request->validate([
            'loan_amount' => 'required|numeric|min:0',
        ]);

        $homeLoan->update([
            'property_value' => $request->input('property_value'),
            'down_payment' => $request->input('down_payment'),
        ]);

        return redirect()->route('clients.edit', $client->id)->with('success', 'Home Loan updated successfully');
    }
}
