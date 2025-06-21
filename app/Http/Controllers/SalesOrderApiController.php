<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Support\Facades\DB;

class SalesOrderApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($request) {
            $order = SalesOrder::create([
                'user_id' => $request->user()->id,
                'total_amount' => 0,
                'status' => 'confirmed',
            ]);

            $total = 0;

            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->quantity < $item['quantity']) {
                    abort(400, "Insufficient stock for {$product->name}");
                }

                $lineTotal = $product->price * $item['quantity'];

                SalesOrderItem::create([
                    'sales_order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'total' => $lineTotal,
                ]);

                $product->decrement('quantity', $item['quantity']);
                $total += $lineTotal;
            }

            $order->update(['total_amount' => $total]);

            return response()->json([
                'message' => 'Sales order created successfully.',
                'order_id' => $order->id,
                'total_amount' => $total
            ], 201);
        });
    }

    public function show($id)
    {
        $order = SalesOrder::with(['items.product', 'user'])->findOrFail($id);

        return response()->json([
            'order_id' => $order->id,
            'user' => $order->user->name,
            'total_amount' => $order->total_amount,
            'status' => $order->status,
            'products' => $order->items->map(function ($item) {
                return [
                    'name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total,
                ];
            }),
        ]);
    }
}
