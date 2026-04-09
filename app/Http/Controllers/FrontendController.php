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
        $products = Product::all();
        $featuredproducts = Product::latest()->take(3)->get();
        return view('gallery', compact('products','featuredproducts'));

    }

    public function about()
    {
        $about = About::first();
        return view('about', compact('about'));
    }

    public function news()
    {
        $news = news::all();
        $featurednews = news::latest()->first();
        return view('news', compact('news','featurednews'));

    }

    public function newsRead(String $id)
    {
        $news = news::findOrFail($id);
        return view('newsRead', compact('news'));

    }

     public function contact()
    {
        $about = About::first();
        $user = auth()->user();

        return view('contact', compact('about','user'));
    }

    public function storeContact(Request $request)
    {
            $validated = $request->validate([
                'subject' => 'required|string|max:100',
                'name' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email|max:100',
                'message' => 'required|string|min:10|max:5000',
            ], 
            
            [
                'subject.required' => 'Subjek harus diisi',
                'name.required' => 'Nama harus diisi',
                'name.regex' => 'Nama hanya boleh berisi huruf',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'message.required' => 'Pesan harus diisi',
                'message.min' => 'Pesan minimal 10 karakter',
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
