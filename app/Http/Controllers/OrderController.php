<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // List all orders
    public function index()
    {
        $orders = Order::with('products')->paginate(10);
        return OrderResource::collection($orders);
    }

    // Create a new order
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => $request->user_id,
                'total_amount' => $request->total_amount,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'status' => 'pending'
            ]);

            // Attach products to order
            foreach ($request->products as $product) {
                $order->products()->attach($product['id'], [
                    'quantity' => $product['quantity'],
                    'price' => $product['price'] ?? 0
                ]);
            }

            DB::commit();

            return new OrderResource($order->load('products'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Order creation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Get a specific order
    public function show($id)
    {
        $order = Order::with('products')->findOrFail($id);
        return new OrderResource($order);
    }

    // Update an existing order
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'in:pending,processing,completed,cancelled',
            'shipping_address' => 'string',
            'payment_method' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $order->update($request->only(['status', 'shipping_address', 'payment_method']));

        return new OrderResource($order);
    }

    // Delete an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        $order = OrderItem::findOrFail($id);
        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully'
        ], 200);
    }
}