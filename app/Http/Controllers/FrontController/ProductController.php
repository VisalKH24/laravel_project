<?php

namespace App\Http\Controllers\FrontController;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Logo;
use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function home(){
        // $Logo = Logo::take(1)->get();

        $newProducts = Product::query()->OrderBy('id', 'DESC')->paginate(4, ['*'], 'new_page');
        $promoProducts = Product::query()
            ->whereColumn('reqular_price', '<>', 'sale_price')
            ->OrderBy('id', 'DESC')
            ->paginate(4, ['*'], 'promo_page');

        $popProducts = Product::query()->OrderBy('views', 'DESC')->paginate(4, ['*'], 'pop_page');
        return view('Frontend.home', compact('newProducts', 'promoProducts', 'popProducts'));
    }
    public function shop(Request $request){
        $query = Product::query()
            ->join('categories', 'products.cate_id', '=', 'categories.id')
            ->select('products.*', 'categories.category_name');

        // Filter by category
        if ($request->filled('cate')) {
            $query->where('categories.category_name', $request->cate);
        }

        // Filter promotion products
        if ($request->promotion === 'true') {
            $query->whereColumn('products.sale_price', '<', 'products.reqular_price');
        }

        // Sort by price
        if ($request->price === 'max') {
            $query->orderBy('products.sale_price', 'desc');
        } elseif ($request->price === 'min') {
            $query->orderBy('products.sale_price', 'asc');
        } else {
            // Default sort: newest
            $query->orderBy('products.id', 'desc');
        }

        // Final data
        $shops = $query->paginate(6)->appends($request->query());
        $cate = Category::all();

        return view('Frontend.shop', compact('cate', 'shops'));
    }
    public function getAllNews(){
        $allNews = News::query()
            ->orderBy('id', 'DESC')
            ->paginate(8);
        return view('frontend.news', compact('allNews'));
    }
    public function newDetail(News $news){
        $relateNews = News::where('id', '!=', $news->id)
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();

        return view('frontend.news-detial', compact('news', 'relateNews'));
    }
    public function searchProduct(Request $request){
        // Get the search term from the query string
        $search = $request->input('search');

        // Perform search query
        $products = Product::where('product_name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();

        // Pass the results to a view
        return view('Frontend.search', compact('products', 'search'));
    }
    public function product(Product $product){
        $relateProduct=Product::query()
                                ->orderBy('id','DESC')
                                ->limit(4)
                                ->where('id','!=',$product->id)
                                ->get();
        Product::query()->where('id',$product->id)->update(['views' => $product->views + 1]);
        return view('Frontend.product',compact('product','relateProduct'));
    }
    public function buyProduct(Product $product,Request $request){

        if ($product->regular_price == 0) {
            $discountAmount = 0;
        } else {
            $discountAmount = $product->regular_price - $product->sale_price;
        }

        // Retrieve quantity from the request
        $quantity = $request->input('quantity');
        $quantity = max($quantity, 1); // Ensure quantity is at least 1

        // Calculate total payment
        $totalPayment = $product->sale_price * $quantity;

        // Pass data to the view
        return view('frontend.buyProduct', compact('product', 'discountAmount', 'quantity', 'totalPayment'));

    }
    public function buyProductSubmit(Product $product){
        return redirect('/shopping');
    }
}
