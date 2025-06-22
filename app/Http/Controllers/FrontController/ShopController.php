<?php

namespace App\Http\Controllers\FrontController;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
{
    $query =Product::query();

    // Filter by category (optional)
    if ($request->has('cate')) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('category_name', $request->cate);
        });
    }

    // Sort by price
    if ($request->price == 'max') {
        $query->orderBy('sale_price', 'desc');
    } elseif ($request->price == 'min') {
        $query->orderBy('sale_price', 'asc');
    }

    // Filter promotion products
    if ($request->promotion == 'true') {
        $query->whereColumn('sale_price', '<', 'reqular_price');
    }

    // Paginate results
    $shops = $query->paginate(12);

    // Categories for sidebar
    $cate =Category::all();

    return view('frontend.shop', compact('shops', 'cate'));
}

}
