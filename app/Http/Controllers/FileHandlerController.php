<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


class FileHandlerController extends Controller
{
    //
    public function HandleFile($slug)
    {
        // $file=Storage::disk('public')->download($slug,['Content-Type' => 'image/jpeg']);
        // $file= base64_decode($file);
        // return $file;
        $path=Storage::disk('public')->path($slug);
        $file=Storage::disk('public')->get($slug);
        $type=File::mimetype($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
