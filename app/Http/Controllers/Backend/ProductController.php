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
            'price' => 'required|',
            'description' => 'required|max:500',
            'image'  => 'required|image|mimes:jpg,png|max:10024',
        ],
        [
            'name.required' => 'Nama wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'description.max' => 'Deskripsi tidak boleh lebih dari 500 karakter',
            
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Gambar harus berformat jpg atau png',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 10MB',
        ]);

        $product = new Product();
        $product ->name = $request->name;
        $product ->price = $request->price;
        $product ->description = $request->description;

        if ($request->hasFile('image')) {
        $file       = $request->file('image');
        $randomName = Str::random(20) . '.' . $file->getClientOriginalExtension();

        //folder tujuan 
        $destinationPath = public_path('uploads/products');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Pindahkan file
        $file->move($destinationPath, $randomName);

        // Set permission file
        @chmod($destinationPath . '/' . $randomName, 0644);

        // Simpan path relatif ke DB
        $product->image = 'uploads/products/' . $randomName;
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
            'price' => 'required|',
            'description' => 'required|max:500',
            'image'  => 'image|mimes:jpg,png|max:10024',
            
        ],
        [
            'name.required' => 'Nama wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'description.max' => 'Deskripsi tidak boleh lebih dari 500 karakter',
            
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Gambar harus berformat jpg atau png',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 10MB',
        ]);

        $product = Product::findOrFail($id);
        $product ->name = $request->name;
        $product ->price = $request->price;
        $product ->description = $request->description;

        if ($request->hasFile('image')) {
            
        $oldPath = public_path($product->image);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }

        $file       = $request->file('image');
        $randomName = Str::random(20) . '.' . $file->getClientOriginalExtension();

        $destinationPath = public_path('uploads/products');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $randomName);
        @chmod($destinationPath . '/' . $randomName, 0644);

        $product->image = 'uploads/products/' . $randomName;
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
