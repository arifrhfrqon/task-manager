<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $videos = Video::all();
        return view('videos.index', compact('videos'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('videos.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'video' => 'required|file|mimetypes:video/mp4,video/x-matroska,video/x-msvideo|max:200000',
            'access_level' => 'required',
            'duration' => 'nullable|integer|min:1'
        ]);

        $path = $request->file('video')->store('videos', 'public');

        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'video_path' => $path,
            'access_level' => $request->access_level,
            'duration' => $request->duration
        ]);

        return redirect()->route('videos.index')->with('success', 'Video berhasil diupload!');
    }

    public function edit(Video $video): \Illuminate\View\View
    {
        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'access_level' => 'required',
            'duration' => 'nullable|integer|min:1',
            'video' => 'nullable|file|mimetypes:video/mp4,video/x-matroska,video/x-msvideo|max:200000'
        ]);

        if ($request->hasFile('video')) {
            Storage::disk('public')->delete($video->video_path);
            $video->video_path = $request->file('video')->store('videos', 'public');
        }

        $video->title = $request->title;
        $video->description = $request->description;
        $video->access_level = $request->access_level;
        $video->duration = $request->duration;
        $video->save();

        return redirect()->route('videos.index')->with('success', 'Video berhasil diperbarui!');
    }

    public function destroy(Video $video): \Illuminate\Http\RedirectResponse
    {
        Storage::disk('public')->delete($video->video_path);
        $video->delete();

        return back()->with('success', 'Video berhasil dihapus!');
    }

    public function staffVideos(): \Illuminate\View\View
    {
        $videos = Video::whereIn('access_level', ['full', 'preview'])->get();
        return view('staff.videos', compact('videos'));
    }

    public function resetAccess(Video $video)
    {
        $video->started_at = now();
        $video->save();

        return back()->with('success', 'Akses staff berhasil diperbarui!');
    }

}
