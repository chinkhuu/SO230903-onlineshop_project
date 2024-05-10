<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status',0)->get();
        $categories = Category::where('status',0)->get();
        return view('frontend.index', compact('sliders','categories'));
    }

    public function products()
    {
        $products = Product::where('status', 0)->where('quantity', '>', 0)->get();
        return view('frontend.product.index', compact('products'));
    }

    public function productShow($slug)
    {
        $product = Product::where('slug',$slug)->firstOrFail();

        $discounted_price = $product->price - ($product->sale_percent * $product->price)/ 100;

        $related_products = Product::where('sub_category_id', $product->sub_category_id)
            ->where('status',0)
            ->where('quantity', '>', 0)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('frontend.product.show', compact('product',
            'discounted_price',
            'related_products'));
    }

    public function productAddCart(Request $request)
    {

    }
}
