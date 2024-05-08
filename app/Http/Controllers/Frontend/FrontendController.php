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
        $sliders = Slider::all();
        $categories = Category::all();
        return view('frontend.index', compact('sliders','categories'));
    }

    public function shop()
    {
        $products = Product::all();
        return view('frontend.shop', compact('products'));
    }
}
