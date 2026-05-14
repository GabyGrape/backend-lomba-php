<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $query = Purchase::query()->with('user');

        // Filter by user_id yang rolenya pedagang
        $query->whereHas('user', function($q) {
            $q->where('role', 'pedagang');
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

    public function store(Request $request)
    {
        $data = $request->all();
        
        // Logic auto-calculate
        $data['total_purchase_price'] = $request->quantity * $request->unit_price;
        $data['used_stock'] = $request->quantity - $request->remaining_stock;
        $data['total_sold_price'] = $request->sold_quantity * $request->selling_price;

        $purchase = Purchase::create($data);
        return response()->json(['message' => 'Success', 'data' => $purchase], 201);
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