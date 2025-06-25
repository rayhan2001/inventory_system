<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Journal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('items')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric',
            'received_amount' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $discount = $request->discount ?? 0;
            $subTotal = 0;

            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['product_id']);
                $subTotal += $product->sell_price * $item['quantity'];
            }

            $afterDiscount = $subTotal - $discount;
            $vat = ($afterDiscount * 0.05);
            $totalAmount = $afterDiscount + $vat;
            $received = $request->received_amount;
            $due = $totalAmount - $received;

            $sale = Sale::create([
                'sale_date' => Carbon::now(),
                'total_amount' => $totalAmount,
                'discount' => $discount,
                'vat' => $vat,
                'received_amount' => $received,
                'due_amount' => $due,
            ]);

            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['product_id']);
                $quantity = $item['quantity'];

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->sell_price,
                ]);

                $product->decrement('stock', $quantity);
            }

            Journal::create([
                'type' => 'sales',
                'amount' => $subTotal,
                'entry_date' => now(),
                'sale_id' => $sale->id,
            ]);

            if ($discount > 0) {
                Journal::create([
                    'type' => 'discount',
                    'amount' => $discount,
                    'entry_date' => now(),
                    'sale_id' => $sale->id,
                ]);
            }

            if ($vat > 0) {
                Journal::create([
                    'type' => 'vat',
                    'amount' => $vat,
                    'entry_date' => now(),
                    'sale_id' => $sale->id,
                ]);
            }

            Journal::create([
                'type' => 'cash',
                'amount' => $received,
                'entry_date' => now(),
                'sale_id' => $sale->id,
            ]);

            if ($due > 0) {
                Journal::create([
                    'type' => 'due',
                    'amount' => $due,
                    'entry_date' => now(),
                    'sale_id' => $sale->id,
                ]);
            }

            DB::commit();

            return redirect()->route('sales.index')->with('success', 'Sale completed successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
