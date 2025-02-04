<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    // List all orders
    public function index()
    {
        $orders = Order::with('products')->paginate(10);
        return OrderResource::collection($orders);
    }

    // Create a new order
    public function store(OrderRequest $request)
    {
        try {
            DB::beginTransaction();
    
            $order = Order::createOrders($request->user_id, $request->total_amount, $request->shipping_address, $request->payment_method);
    
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
        $order = Order::getOrdersWithProducts($id);
        return new OrderResource($order);
    }

    // Update an existing order
    public function update(UpdateOrderRequest $request, $id)
    {
        // Use the new method to find the order
        $order = Order::findOrFailOrder($id);

        // Update the order with validated data
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