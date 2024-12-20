<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::paginate(10); // Use pagination
            return view('products.index', compact('products'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch products');
        }
    }
}
