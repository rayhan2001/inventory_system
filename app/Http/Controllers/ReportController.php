<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from ?? now()->startOfMonth()->toDateString();
        $to = $request->to ?? now()->toDateString();

        $sales = Journal::where('type', 'sales')->whereBetween('entry_date', [$from, $to])->sum('amount');
        $discount = Journal::where('type', 'discount')->whereBetween('entry_date', [$from, $to])->sum('amount');
        $vat = Journal::where('type', 'vat')->whereBetween('entry_date', [$from, $to])->sum('amount');
        $cash = Journal::where('type', 'cash')->whereBetween('entry_date', [$from, $to])->sum('amount');
        $due = Journal::where('type', 'due')->whereBetween('entry_date', [$from, $to])->sum('amount');
        $profit = SaleItem::whereHas('sale', function ($q) use ($from, $to) {
            $q->whereBetween('sale_date', [$from, $to]);
        })->get()->sum(function ($item) {
            $buy = $item->product->purchase_price;
            $sell = $item->price;
            return ($sell - $buy) * $item->quantity;
        });

        return view('reports.index', compact('from', 'to', 'sales', 'discount', 'vat', 'cash', 'due', 'profit'));
    }
}
