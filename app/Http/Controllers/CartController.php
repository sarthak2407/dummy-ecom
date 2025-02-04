<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CartController extends Controller
{
    // public function addToCart(Request $request, $productId)
    // {
    //     $product = Product::findOrFail($productId);
    //     $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        
    //     $cart->products()->attach($productId, ['quantity' => $request->quantity]);

    //     return redirect()->back()->with('success', 'Product added to cart!');
    // }

    public function addToCart($encryptedProductId, Request $request)
    {
        try {
            // Decrypt the productId
            $productId = Crypt::decryptString($encryptedProductId);
            
            // Find the product using the decrypted ID
            $product = Product::findOrFail($productId);
            
            // Get the quantity from the request
            // $quantity = $request->input('quantity', 1);
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        
            $cart->products()->attach($productId, ['quantity' => $request->quantity]);

            // Your existing cart logic here
            // Example: add to session or cart
            // Cart::add($product, $quantity);

            return redirect()->route('dashboard')->with('success', 'Product added to cart!');
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', 'Invalid product.');
        }
    }


    public function viewCart()
    {
        $cart = Cart::with('products')->where('user_id', Auth::id())->first()->toArray();
        return view('cart.index', compact('cart'));
    }

    public function placeOrder()
    {
        $cart = Cart::with('products')->where('user_id', Auth::id())->first();

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
        $orders = Order::with('products')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('accounts.orders', compact('orders'));
    }
    public function showOrderProduct(Request $request)
    {
        $orders = Order::with('products')->where('id',$request->order_id)->first();
        $products = $orders->products;
        return view('accounts.products', compact('products'));

        // return response()->json([
        //     'name' => $product->name,
        //     'description' => $product->description,
        //     'price' => $product->price,
        //     'category' => $product->category->name, // Assuming category is a relationship
        //     'stock' => $product->stock,
        // ]);
    }
}
