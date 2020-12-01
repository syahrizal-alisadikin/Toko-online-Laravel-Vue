<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'List data Category',
            'categories' => $categories
        ]);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            return response()->json([
                'success' => true,
                'message' => 'List Product By Category :' . $category->name,
                'product' => $category->products()->latest()->get()
            ]);
        } else {

            return response()->json([
                'success' => false,
                'message' => 'Data Product By Category Tidak Ditemukan',
            ], 404);
        }
    }

    public function categoryHeader()
    {
        $categories = Category::latest()->take(5)->get();
        return response()->json([
            'success'       => true,
            'message'       => 'List Data Category Header',
            'categories'    => $categories
        ]);
    }
}
