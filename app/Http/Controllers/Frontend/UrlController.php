<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class UrlController extends Controller
{
    public function store(Request $request)
    {
        // Validate the URL input
        $request->validate([
            'original_url' => 'required|url',
        ]);

        // Generate a short code
        $shortCode = Str::random(6);

        // Store the original URL and short code in Redis
        Redis::set($shortCode, $request->original_url);

        // Store the mapping in the database as well
        Url::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
        ]);

        // Redirect back to the form with the short URL
        return redirect('/')->with('short_url', url($shortCode));
    }

    public function redirect($shortCode)
    {
        // Retrieve the original URL from Redis
        $originalUrl = Redis::get($shortCode);

        if ($originalUrl) {
            return redirect($originalUrl);
        } else {
            return response()->json(['error' => 'URL not found'], 404);
        }
    }
}
