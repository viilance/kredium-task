<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCashLoanRequest;
use App\Http\Requests\UpdateCashLoanRequest;
use App\Models\CashLoan;
use App\Models\Client;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

class CashLoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param StoreCashLoanRequest $request
     * @param Client $client
     * @return RedirectResponse
     */
    public function store(StoreCashLoanRequest $request, Client $client): RedirectResponse
    {
        $cashLoan = new CashLoan([
            'loan_amount' => $request->input('loan_amount'),
        ]);
        $cashLoan->client()->associate($client);
        $cashLoan->adviser()->associate($request->user());
        $cashLoan->save();

        return redirect()->route('clients.edit', $client->id)
            ->with('success', 'Cash Loan created successfully');
    }

    /**
     * @param UpdateCashLoanRequest $request
     * @param Client $client
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateCashLoanRequest $request, Client $client): RedirectResponse
    {
        $cashLoan = $client->cashLoan;

        $this->authorize('update', $cashLoan);

        $cashLoan->update([
            'loan_amount' => $request->input('loan_amount'),
        ]);

        return redirect()->route('clients.edit', $client->id)
            ->with('success', 'Cash Loan updated successfully');
    }
}
