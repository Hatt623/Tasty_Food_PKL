<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News; 

use Storage;
use Illuminate\Support\Str;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest()->get();
        $title = 'Delete Data';
        $text = 'Apakah Anda yakin?';
        confirmDelete($title,$text);

        return view('backend.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|',
            'description' => 'required|max:10000',
            'image'  => 'required|image|mimes:jpg,png|max:4024',
        ]);

        $news = new News();
        $news ->title = $request->title;
        $news ->description = $request->description;

        if ($request->hasFile('image')) {
            $file           = $request->file('image');
            $randomName     = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path           = $file->storeAs('news', $randomName, 'public');
            // memasukkan nama image nya ke database
            $news->image = $path;
        }

        $news->save();
        toast('Data berhasil ditambah', 'success');
        return redirect()->route('backend.news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $news = News::findOrFail($id);
        return view('backend.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::findOrFail($id);

        return view('backend.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|',
            'description' => 'required|max:10000',
            'image'  => 'image|mimes:jpg,png|max:4024',
        ]);

        $news = News::findOrFail($id);
        $news ->title = $request->title;
        $news ->description = $request->description;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);

            $file           = $request->file('image');
            $randomName     = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path           = $file->storeAs('news', $randomName, 'public');
            // memasukkan nama image nya ke database
            $news->image = $path;
        }

        $news->save();
        toast('Data berhasil ditambah', 'success');
        return redirect()->route('backend.news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        Storage::disk('public')->delete($news->image);
        $news->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.news.index');
    }
}
