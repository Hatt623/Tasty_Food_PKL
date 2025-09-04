<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\News;
use App\Models\About;
use App\Models\Contact;


class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->take(8)->get();
        $latestproducts = Product::latest()->take(4)->get();

        $news = News::latest()->take(8)->get();
        $latestnews = News::latest()->take(5)->get();

        $about = About::first();

        return view('index', compact('products','latestproducts','news','latestnews','about'));
    }
}
