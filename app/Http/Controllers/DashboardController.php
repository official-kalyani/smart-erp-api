<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = SalesOrder::sum('total_amount');
        $totalOrders = SalesOrder::count();
        $lowStockProducts = Product::where('quantity', '<', 10)->get();
        
        return view('dashboard.index', compact('totalSales', 'totalOrders', 'lowStockProducts'));
    }
}
