<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\ShortUrl;


class ShortUrlController extends Controller
{
    /**
     * Display a listing of the url.
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = auth()->user();
        $shortUrls = $user->shortUrls;
        return response()->json($shortUrls);
    }



    /**
     * Store a newly created url in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'long_url' => 'required|url',
            'description' => 'required|string|max:255',
            'clicks' => 'sometimes|integer|min:0',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Generate short code
        $validatedData = $validator->validated();
        $validatedData['short_code'] = $this->generateShortCode();

        $shortUrl = ShortUrl::create($validatedData);
        return response()->json($shortUrl, 201);
    }

    /**
     * Display the specified url.
     */
    public function show(ShortUrl $shortUrl)
    {
        return response()->json($shortUrl);
    }



    /**
     * Update the specified url in storage.
     */
    public function update(Request $request, ShortUrl $shortUrl)
    {
        $validator = Validator::make($request->all(), [
            'long_url' => 'required|url',
            'description' => 'required|string|max:255',
            'clicks' => 'sometimes|integer|min:0',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $shortUrl->update($validator->validated());
        return response()->json($shortUrl);
    }

    /**
     * Remove the specified url from storage.
     */
    public function destroy(ShortUrl $shortUrl)
    {
        $shortUrl->delete();
        return response()->json(null, 204);
    }
    /**
     * visite the specified url from storage.
     */
    public function visite(Request $request)
    {

        $short_code = $request->short_code;
        $shortUrl = ShortUrl::WHERE('short_code', $short_code)->firstOrFail();
        // Increment the click count
        $shortUrl->increment('clicks');
        return redirect($shortUrl->long_url);
    }

    // Logic to generate a unique short code
    protected function generateShortCode()
    {

        return substr(md5(mt_rand()), 0, 6);
    }
}
