<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    // Encode URL to short URL Function
    public function encode(Request $request)
    {
        try {
            $request->validate(['url' => 'required|url']);

            $existingUrl = ShortUrl::where('original_url', $request->url)->first();
            if ($existingUrl) {
                return response()->json([
                    'short_url' => url($existingUrl->short_code)
                ]);
            }

            $shortCode = Str::random(6);

            $shortUrl = ShortUrl::create([
                'original_url' => $request->url,
                'short_code' => $shortCode
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'URL has been shortened',
                'original_url' => $shortUrl->original_url,
                'short_code' => $shortUrl->short_code,
                'short_url' => url($shortUrl->short_code)
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // Decode URL to original URL Function
    public function decode($code)
    {
        try {
            // code size should be 6
            if (strlen($code) !== 6) {
                return response()->json(['error' => 'Invalid short code size'], 400);
            }
            // check if the code exists
            $shortUrl = ShortUrl::where('short_code', $code)->first();

            if (!$shortUrl) {
                return response()->json(['error' => 'URL not found'], 404);
            }

            return response()->json(
                [
                         'status' => 'success',
                        'message' => 'URL has been decoded',
                        'original_url' => $shortUrl->original_url,
                    ]
            );

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}

