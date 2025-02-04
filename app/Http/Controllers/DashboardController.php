<?php

namespace App\Http\Controllers;

use App\Models\Product; // Make sure to import the Product model
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve all products from the database
        $products = Product::all();

        // Return the dashboard view with the products data
        return view('dashboard', compact('products'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        if (empty($search)) {
            $products = Product::paginate(10); // Return paginated results
        } else {
            // Search for products with the given search term
            $products = Product::where('name', 'like', "%$search%")->paginate(10); // Paginate results
        }
    

        return view('dashboard', ['products' => $products]);
    }
}
