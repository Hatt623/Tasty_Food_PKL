<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereIn('role', ['admin','staff'])->latest()->get();
        $title = 'Delete Data';
        $text = 'Apakah Anda yakin?';
        confirmDelete($title,$text);

        return view('backend.staff.index', compact('user'));
    }

     public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.staff.show', compact('user'));
    }

    public function create()
    {
        return view('backend.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'role'     => 'staff', 
        ]);

        toast('Staff account created successfully', 'success');
        return redirect()->route('backend.staff.index');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.staff.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        if ($user->role == 'admin') {
             $user->update([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'phone'    => $request->phone,
                'role'     => 'admin', 
            ]);

            $user->save();
            toast('Data berhasil diubah', 'success');    
            return redirect()->route('backend.staff.index');
        }
        
        else
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'role'     => 'staff', 
        ]);

        $user->save();
        toast('Data berhasil diubah', 'success');
        return redirect()->route('backend.staff.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.staff.index');
    }
}
