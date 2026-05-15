<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\InventoryStock;
use App\Models\DailyFinancialReport;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        // $query = Purchase::query()->with('user');

        // // Filter by user_id yang rolenya pedagang
        // $query->whereHas('user', function($q) {
        //     $q->where('role', 'pedagang');
        // });
        $query = Purchase::query()->with('user.role');

    // Filter pedagang yang benar melalui relasi role_id
    $query->whereHas('user.role', function($q) {
        $q->where('name', 'pedagang'); 
    });

        // Filter by user_id spesifik
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by Date Range
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('effective_date', [$request->start_date, $request->end_date]);
        }

        return response()->json($query->get());
    }

    // public function store(Request $request)
    // {
    //     $data = $request->all();
        
    //     // Logic auto-calculate
    //     $data['total_purchase_price'] = $request->quantity * $request->unit_price;
    //     $data['used_stock'] = $request->quantity - $request->remaining_stock;
    //     $data['total_sold_price'] = $request->sold_quantity * $request->selling_price;

    //     $purchase = Purchase::create($data);
    //     return response()->json(['message' => 'Success', 'data' => $purchase], 201);
    // }
    public function store(Request $request)
{
    // Validasi input dulu agar aman
    $request->validate([
        'user_id' => 'required',
        'product_name' => 'required',
        'quantity' => 'required|numeric|min:0',
        'unit_price' => 'required|numeric|min:0',
        'remaining_stock' => 'nullable|numeric',
    ]);

    return DB::transaction(function () use ($request) {
        $data = $request->all();

        // 1. Logika Auto-calculate milikmu tetap dijalankan
        $data['total_purchase_price'] = $request->quantity * $request->unit_price;
        
        // Catatan: Biasanya saat beli barang baru, used_stock itu 0. 
        // Tapi kita ikuti logic awalmu:
        $remaining = $request->remaining_stock ?? $request->quantity;
        $data['used_stock'] = $request->quantity - $remaining;
        
        // Simpan ke tabel purchases
        $purchase = Purchase::create($data);

        // 2. Update Inventory Stock (Moving Average Logic)
        // Kita cari stok barang ini milik merchant tersebut
        $stock = InventoryStock::firstOrNew([
            'merchant_id' => $request->user_id,
            'product_name' => $request->product_name
        ]);

        // Rumus Moving Average: (Nilai Stok Lama + Nilai Pembelian Baru) / Total Qty Baru
        $currentTotalValue = $stock->total_quantity * $stock->average_unit_price;
        $newPurchaseValue = $data['total_purchase_price'];
        
        $newTotalQuantity = $stock->total_quantity + $request->quantity;

        if ($newTotalQuantity > 0) {
            $stock->average_unit_price = ($currentTotalValue + $newPurchaseValue) / $newTotalQuantity;
        }

        $stock->total_quantity = $newTotalQuantity;
        $stock->total_inventory_value = $stock->total_quantity * $stock->average_unit_price;
        $stock->save();

        // 3. Update Laporan Keuangan Harian (Total Pengeluaran Beli Stok)
        $report = DailyFinancialReport::firstOrCreate([
            'merchant_id' => $request->user_id,
            'report_date' => now()->toDateString()
        ]);
        
        // Tambahkan total pembelian hari ini ke laporan
        $report->increment('total_purchases', $data['total_purchase_price']);

        return response()->json([
            'status' => 'success',
            'message' => 'Purchase recorded and Inventory updated',
            'data' => [
                'purchase' => $purchase,
                'current_stock_level' => $stock->total_quantity,
                'new_average_price' => $stock->average_unit_price
            ]
        ], 201);
    });
}

    public function update(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->update($request->all());
        return response()->json(['message' => 'Updated', 'data' => $purchase]);
    }

    public function destroy($id)
    {
        Purchase::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}