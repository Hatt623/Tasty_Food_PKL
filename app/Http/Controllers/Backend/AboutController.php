<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About; 

use Storage;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::latest()->get();
        $title = 'Delete Data';
        $text = 'Apakah Anda yakin?';
        confirmDelete($title,$text);

        return view('backend.about.index', compact('about'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $about = About::findOrFail($id);
        return view('backend.about.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $about = About::findOrFail($id);
        return view('backend.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'about' => 'required|max:1000',
            'vision' => 'required|max:1000',
            'mission' => 'required|max:1000',

            'image_vision'  => 'image|mimes:jpg,png|max:10024',
            'image_mission'  => 'image|mimes:jpg,png|max:10024',
        ]);
    
        $about = About::findOrFail($id);
        $about ->about = $request->about;
        $about ->vision = $request->vision;
        $about ->mission = $request->mission;

        // folder tujuan
        $destinationPath = public_path('uploads/abouts');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Hapus file lama 
        if ($request->hasFile('image_vision')) {
            if ($about->image_vision && file_exists(public_path($about->image_vision))) {
                unlink(public_path($about->image_vision));
            }
            $fileVision   = $request->file('image_vision');
            $randomVision = Str::random(20) . '.' . $fileVision->getClientOriginalExtension();
            $fileVision->move($destinationPath, $randomVision);
            @chmod($destinationPath . '/' . $randomVision, 0644);
            $about->image_vision = 'uploads/abouts/' . $randomVision;
        }

        if ($request->hasFile('image_mission')) {
            if ($about->image_mission && file_exists(public_path($about->image_mission))) {
                unlink(public_path($about->image_mission));
            }
            $fileMission   = $request->file('image_mission');
            $randomMission = Str::random(20) . '.' . $fileMission->getClientOriginalExtension();
            $fileMission->move($destinationPath, $randomMission);
            @chmod($destinationPath . '/' . $randomMission, 0644);
            $about->image_mission = 'uploads/abouts/' . $randomMission;
        }


        $about->save();
        toast('Data berhasil diubah', 'success');
        return redirect()->route('backend.about.index');
    }

    public function edit2(string $id)
    {
        $about = About::findOrFail($id);
        return view('backend.about.edit2', compact('about'));
    }

    public function updateAbout2(Request $request, string $id)
    {
       $request->validate([
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'map_embed' => 'required|string|regex:/iframe|<iframe/',
        ], 
        
        [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',

            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',

            'address.required' => 'Alamat lengkap wajib diisi.',

            'map_embed.required' => 'Kode iframe peta wajib diisi.',
            'map_embed.regex' => 'Format salah! Silakan masukkan kode "Embed a map" (HTML iframe) dari Google Maps.',
        ]);
    
        $about = About::findOrFail($id);
        $about ->email = $request->email;
        $about ->phone = $request->phone;
        $about ->address = $request->address;
        $about ->map_embed = $request->map_embed;

        $about->save();
        toast('Data berhasil diubah', 'success');
        return redirect()->route('backend.about.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $about = About::findOrFail($id);
        Storage::disk('public')->delete($about->image_vision);
        Storage::disk('public')->delete($about->image_mission);
        $about->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.about.index');
    }
}