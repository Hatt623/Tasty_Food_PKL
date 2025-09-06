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
        $products = Product::latest()->take(6)->get();
        $latestproducts = Product::latest()->take(4)->get();

        $news = News::latest()->take(8)->get();
        $latestnews = News::latest()->take(5)->get();

        $about = About::first();

        return view('index', compact('products','latestproducts','news','latestnews','about'));
    }

    public function gallery()
    {
        $about = About::first();
        $products = Product::all();
        $featuredproducts = Product::latest()->take(3)->get();
        return view('gallery', compact('products','featuredproducts','about'));

    }

    public function about()
    {
        $about = About::first();
        return view('about', compact('about'));
    }

    public function news()
    {
        $about = About::first();
        $news = news::all();
        $featurednews = news::first();
        return view('news', compact('news','featurednews','about'));

    }

     public function contact()
    {
        $about = About::first();
        return view('contact', compact('about'));

    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'subject' => 'required|min:1|max:100',
            'name' => 'required|min:1|max:100',
            'email' => 'required|min:1|max:100',
            'message' => 'required|min:1',
        ]);

        $contact = new Contact();
        $contact ->subject  = $request->subject;
        $contact ->name     = $request->name;
        $contact ->email    = $request->email;
        $contact ->message  = $request->message;

        $contact->save();
        toast('Pesanmu berhasil dikirim', 'success');
        return redirect()->route('contact.index');
    }
}
