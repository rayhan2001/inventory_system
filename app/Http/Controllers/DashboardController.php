<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Journal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');

        $salesThisMonth = Sale::whereMonth('sale_date', now()->month)->get();

        $totalSaleAmount = $salesThisMonth->sum('total_amount');
        $totalDue = $salesThisMonth->sum('due_amount');
        $totalReceived = $salesThisMonth->sum('received_amount');

        $profit = SaleItem::whereHas('sale', function ($q) {
            $q->whereMonth('sale_date', now()->month);
        })->get()->sum(function ($item) {
            $buy = $item->product->purchase_price;
            $sell = $item->price;
            return ($sell - $buy) * $item->quantity;
        });

        return view('dashboard', compact('totalProducts','totalStock','totalSaleAmount','totalDue','totalReceived','profit'));
    }
}
