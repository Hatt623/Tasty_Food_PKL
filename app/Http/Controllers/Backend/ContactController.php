<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact; 

use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::latest()->get();
        $title = 'Delete Data';
        $text = 'Apakah Anda yakin?';
        confirmDelete($title,$text);

        return view('backend.contact.index', compact('contact'));
    }

    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('backend.contact.show', compact('contact'));
    }

    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.contact.index');
    }
}
