<?php

namespace App\Repositories;

use App\DataTransferObjects\Product;
use App\Models\CashLoan;
use App\Models\HomeLoan;
use Illuminate\Support\Collection;

class ProductRepository
{
    /**
     * @param int $adviserId
     * @return Collection
     */
    public function getProductsByAdviser(int $adviserId): Collection
    {
        $cashLoans = CashLoan::where('adviser_id', $adviserId)
            ->select('id', 'loan_amount', 'created_at')
            ->get()
            ->map(function ($cashLoan) {
                return new Product(
                    $cashLoan->id,
                    'Cash Loan',
                    $cashLoan->loan_amount,
                    $cashLoan->created_at
                );
            });

        $homeLoans = HomeLoan::where('adviser_id', $adviserId)
            ->select('id', 'property_value', 'down_payment', 'created_at')
            ->get()
            ->map(function ($homeLoan) {
                $productValue = $homeLoan->property_value - $homeLoan->down_payment;

                return new Product(
                    $homeLoan->id,
                    'Home Loan',
                    $productValue,
                    $homeLoan->created_at
                );
            });

        return $cashLoans->toBase()->merge($homeLoans)->sortByDesc('created_at')->values();
    }
}
