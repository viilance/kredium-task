<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    protected ProductRepository $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->middleware('auth');
        $this->productRepository = $productRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $adviserId = Auth::id();

        $products = $this->productRepository->getProductsByAdviser($adviserId);

        return view('reports.index', compact('products'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        $adviserId = Auth::id();

        $products = $this->productRepository->getProductsByAdviser($adviserId);

        $csvData = [];
        $csvData[] = ['Product Type', 'Product Value', 'Creation Date'];

        foreach ($products as $product) {
            $csvData[] = [
                $product->productType,
                $product->productValue,
                $product->createdAt->format('Y-m-d'),
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
