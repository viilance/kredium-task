<?php

namespace App\Http\Controllers;

use App\Models\CashLoan;
use App\Models\Client;
use App\Models\HomeLoan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $adviserId = auth()->id();

        $cashLoans = CashLoan::where('adviser_id', $adviserId)
            ->select('id', 'loan_amount as product_value', 'created_at')
            ->addSelect(\DB::raw("'Cash Loan' as product_type"))
            ->addSelect(\DB::raw('NULL as down_payment'))
            ->get();

        $homeLoans = HomeLoan::where('adviser_id', $adviserId)
            ->select('id', 'property_value', 'down_payment', 'created_at')
            ->addSelect(\DB::raw("'Home Loan' as product_type"))
            ->addSelect(\DB::raw('property_value - down_payment as product_value'))
            ->get();

        $products = $cashLoans->toBase()->merge($homeLoans)->sortByDesc('created_at');

        return view('reports.index', compact('products'));
    }

    public function export()
    {
        $adviserId = auth()->id();

        // Retrieve products as before
        $cashLoans = CashLoan::where('adviser_id', $adviserId)
            ->select('id', 'loan_amount as product_value', 'created_at')
            ->addSelect(\DB::raw("'Cash Loan' as product_type"))
            ->addSelect(\DB::raw('NULL as down_payment'))
            ->get();

        $homeLoans = HomeLoan::where('adviser_id', $adviserId)
            ->select('id', 'property_value', 'down_payment', 'created_at')
            ->addSelect(\DB::raw("'Home Loan' as product_type"))
            ->addSelect(\DB::raw('property_value - down_payment as product_value'))
            ->get();

        $products = $cashLoans->toBase()->merge($homeLoans)->sortByDesc('created_at');

        $csvData = [];
        $csvData[] = ['Product Type', 'Product Value', 'Creation Date'];

        foreach ($products as $product) {
            $csvData[] = [
                $product->product_type,
                $product->product_value,
                $product->created_at->format('Y-m-d'),
            ];
        }

        $filename = 'adviser_report_' . date('Y_m_d_H_i_s') . '.csv';
        $handle = fopen($filename, 'w');

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend();
    }

}
