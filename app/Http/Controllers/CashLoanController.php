<?php

namespace App\Http\Controllers;

use App\Models\CashLoan;
use App\Models\Client;
use Illuminate\Http\Request;

class CashLoanController extends Controller
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
            'loan_amount' => 'required|numeric|min:0',
        ]);

        if ($client->cashLoan) {
            return back()->withErrors(['loan' => 'This client already has a Cash Loan.'])->withInput();
        }

        CashLoan::create([
            'client_id' => $client->id,
            'adviser_id' => auth()->id(),
            'loan_amount' => $request->input('loan_amount'),
        ]);

        return redirect()->route('clients.edit', $client->id)->with('success', 'Cash Loan created successfully');
    }

    public function update(Request $request, $clientId)
    {
        $client = Client::findOrFail($clientId);

        if ($client->adviser_id !== auth()->id()) {
            abort(403);
        }

        $cashLoan = $client->cashLoan;

        if (!$cashLoan) {
            return back()->withErrors(['loan' => 'No Cash Loan found for this client.'])->withInput();
        }

        $request->validate([
            'loan_amount' => 'required|numeric|min:0',
        ]);

        $cashLoan->update([
            'loan_amount' => $request->input('loan_amount'),
        ]);

        return redirect()->route('clients.edit', $client->id)->with('success', 'Cash Loan updated successfully');
    }
}
