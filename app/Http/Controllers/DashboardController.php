<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\BorrowTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $assetCount = Assets::count();
        $borrowedCount = BorrowTransaction::where('status', 'borrowed')->count();
        $returnedCount = BorrowTransaction::where('status', 'returned')->count();

        $borrowedData = BorrowTransaction::selectRaw('MONTH(borrowed_date) as month, COUNT(*) as total')
            ->where('status', 'borrowed')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // 📊 Returned per month
        $returnedData = BorrowTransaction::selectRaw('MONTH(returned_date) as month, COUNT(*) as total')
            ->where('status', 'returned')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $months = [];
        $borrowedTotals = [];
        $returnedTotals = [];

        // make sure months align
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('F');
            $borrowedTotals[] = $borrowedData[$i] ?? 0;
            $returnedTotals[] = $returnedData[$i] ?? 0;
        }
        return view('dashboard', compact(
            'assetCount',
            'borrowedCount',
            'returnedCount',
            'months',
            'borrowedTotals',
            'returnedTotals'
        ));
    }
}
