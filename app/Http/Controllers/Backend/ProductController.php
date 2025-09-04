<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 

use Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::latest()->get();
        $title = 'Delete Data';
        $text = 'Apakah Anda yakin?';
        confirmDelete($title,$text);

        return view('backend.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|',
            'description' => 'required|max:500',
            'image'  => 'required|image|mimes:jpg,png|max:10024',
        ]);

        $product = new Product();
        $product ->name = $request->name;
        $product ->description = $request->description;

        if ($request->hasFile('image')) {
            $file           = $request->file('image');
            $randomName     = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path           = $file->storeAs('products', $randomName, 'public');
            // memasukkan nama image nya ke database
            $product->image = $path;
        }

        $product->save();
        toast('Data berhasil ditambah', 'success');
        return redirect()->route('backend.product.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('backend.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|',
            'description' => 'required|max:500',
            'image'  => 'image|mimes:jpg,png|max:10024',
        ]);

        $product = Product::findOrFail($id);
        $product ->name = $request->name;
        $product ->description = $request->description;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);

            $file           = $request->file('image');
            $randomName     = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path           = $file->storeAs('products', $randomName, 'public');
            // memasukkan nama image nya ke database
            $product->image = $path;
        }

        $product->save();
        toast('Data berhasil diubah', 'success');
        return redirect()->route('backend.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        Storage::disk('public')->delete($product->image);
        $product->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.product.index');
    }
}
