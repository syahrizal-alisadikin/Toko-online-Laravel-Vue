<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data Product',
            'product' => $product
        ], 200);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Product',
                'product' => $product
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }
}
