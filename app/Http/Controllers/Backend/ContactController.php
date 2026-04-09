<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact; 

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReplyMail;

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

    # TURN OFF NORTON(OR ANY ANTIVIRUS) EMAIL PROTECTION TO ENABLE EMAIL SENDING
    public function reply(Request $request, Contact $contact)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ],
        [
            'reply.required' => 'Balasan wajib diisi',
            'reply.string'   => 'Balasan harus berupa teks',
            'reply.max'      => 'Balasan tidak boleh lebih dari 1000 karakter',
        ]);

        Mail::to($contact->email)->send(new ContactReplyMail($contact, $request->reply));

        $contact->update(['reply' => $request->reply]);

        toast('Balasan berhasil dikirim', 'success');
        return redirect()->route('backend.contact.index');
    }


}
