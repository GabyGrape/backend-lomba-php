<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DailyFinancialReport;
use Illuminate\Http\Request;

class FinancialReportController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['user_id' => 'required']);
        $merchantId = $request->user_id;
        
        $query = DailyFinancialReport::where('merchant_id', $merchantId);

        // Filter per bulan jika ada (format: 1-12)
        if ($request->month) {
            $query->whereMonth('report_date', $request->month);
        }
        
        // Filter per tahun jika ada
        if ($request->year) {
            $query->whereYear('report_date', $request->year);
        }

        $summary = $query->selectRaw('
                SUM(total_purchases) as total_pengeluaran_stok,
                SUM(total_sales) as total_pendapatan_kotor,
                SUM(total_cogs) as total_harga_pokok_penjualan,
                SUM(gross_profit) as total_laba_kotor,
                SUM(net_profit) as total_laba_bersih
            ')
            ->first();

        return response()->json([
            'status' => 'success',
            'data' => $summary
        ]);
    }
}