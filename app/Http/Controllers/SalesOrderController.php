<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class SalesOrderController extends Controller
{
    public function index()
{
    $orders = SalesOrder::with('items.product')->latest()->get();
    return view('sales_orders.index', compact('orders'));
}

public function create()
{
    $products = Product::all();
    return view('sales_orders.create', compact('products'));
}

public function store(Request $request)
{
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'products' => 'required|array|min:1',
        'products.*.product_id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
    ]);

    $total = 0;
    foreach ($request->products as $item) {
        $product = Product::findOrFail($item['product_id']);
        $total += $product->price * $item['quantity'];
    }

    // ✅ Assign authenticated user ID here
    $order = SalesOrder::create([
        'user_id' => auth()->id(),
        'status' => 'confirmed',
        'total_amount' => $total,
    ]);

    foreach ($request->products as $item) {
        $product = Product::findOrFail($item['product_id']);

        // Reduce inventory
        $product->decrement('quantity', $item['quantity']);

        SalesOrderItem::create([
            'sales_order_id' => $order->id,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $product->price,
        ]);
    }

    return redirect()->route('sales_orders.index')->with('success', 'Sales order created successfully.');

}

public function exportPdf(SalesOrder $salesOrder)
{
    $salesOrder->load('items.product');
    $pdf = Pdf::loadView('sales_orders.pdf', compact('salesOrder'));
    return $pdf->download("SalesOrder-{$salesOrder->id}.pdf");
}
}
