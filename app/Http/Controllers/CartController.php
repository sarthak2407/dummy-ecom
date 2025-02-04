<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CartController extends Controller
{

    public function addToCart($encryptedProductId, Request $request)
    {
        try {
            // Use the new method to find the product
            $product = Product::findByEncryptedId($encryptedProductId);

            // Get the quantity from the request
            $quantity = $request->input('quantity', 1);

            // Use the new method in the Cart model to get or create the cart
            $cart = Cart::getOrCreateCartForUser (Auth::id());

            // Attach the product to the cart with the specified quantity
            $cart->products()->attach($product->id, ['quantity' => $quantity]);

            return redirect()->route('dashboard')->with('success', 'Product added to cart!');
        } catch (\Exception $e) {
            return back()->with('error', 'Invalid product.');
        }
    }


    public function viewCart()
    {
        $cart = Cart::getCartWithProductsForUser(Auth::id())->toArray();
        return view('cart.index', compact('cart'));
    }

    public function placeOrder()
    {
        $cart = Cart::getCartWithProductsForUser(Auth::id());

        if (!$cart || $cart->products->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Create the order
        $order = Order::create([
            'customer_name' => Auth::user()->name,
            'price' => $cart->products->sum(function ($product) {
                return $product->price * $product->pivot->quantity;
            }),
        ]);

        foreach ($cart->products as $product) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity,
                'price' => $product->price,
            ]);
        }

        // Clear the cart after placing the order
        $cart->products()->detach();

        return redirect()->route('account.orders')->with('success', 'Order placed successfully!');
    }

    public function viewOrders()
    {
        $orders = Order::getUserOrders(Auth::id());

        return view('accounts.orders', compact('orders'));
    }
    public function showOrderProduct(Request $request)
    {
        // Using the new method in the Order model
        $orders = Order::getOrderWithProducts($request->order_id);
        
        // Make sure to check if the order exists
        if ($orders) {
            $products = $orders->products;
            return view('accounts.products', compact('products'));
        }
    
        // Optionally, handle the case where the order does not exist
        return redirect()->back()->with('error', 'Order not found.');
    }
}
