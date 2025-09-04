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
            'about' => 'required|max:200',
            'vision' => 'required|max:200',
            'mission' => 'required|max:200',

            'image_vision'  => 'image|mimes:jpg,png|max:10024',
            'image_mission'  => 'image|mimes:jpg,png|max:10024',
        ]);

        $about = About::findOrFail($id);
        $about ->about = $request->about;
        $about ->vision = $request->vision;
        $about ->mission = $request->mission;

        if ($request->hasFile('image_vision') && $request->hasFile('image_mission')) {
            Storage::disk('public')->delete($about->image_vision, $about->image_mission);

            $fileVision           = $request->file('image_vision');
            $fileMission           = $request->file('image_mission');

            $pathVision = $fileVision->storeAs('abouts', Str::random(20) . '.' . $fileVision->getClientOriginalExtension(), 'public');
            $pathMission = $fileMission->storeAs('abouts', Str::random(20) . '.' . $fileMission->getClientOriginalExtension(), 'public');

            // memasukkan nama image nya ke database
            $about->image_vision = $pathVision;
            $about->image_mission = $pathMission;

        }

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
        Storage::disk('public')->delete($about->image_vision, $about->image_mission);
        $about->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.about.index');
    }
}
