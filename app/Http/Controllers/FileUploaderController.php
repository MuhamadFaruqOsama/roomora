<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileUploaderController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'photo_evidence' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        if ($request->hasFile('photo_evidence')) {
            $path = $request->file('photo_evidence')->store('uploads', 'public');
            
            return response($path, 200);
        }

        return response('No file uploaded', 400);
    }

    public function revert(Request $request)
    {
        $file = $request->getContent();

        if ($file) {
            Storage::disk('public')->delete($file);
            return response()->json(['message' => 'File deleted']);
        }

        return response()->json(['message' => 'No file specified'], 400);
    }
}
