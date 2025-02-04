<?php

namespace App\Http\Controllers;

use App\Models\Product; // Make sure to import the Product model
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve all products using the model's method
        $products = Product::getAllProducts();

        // Return the dashboard view with the products data
        return view('dashboard', compact('products'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::search($search); // Call the search method in the Product model
    
        return view('dashboard', ['products' => $products]);
    }
}
