<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsImageRequest;
use App\Http\Requests\UpdateNewsImageRequest;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(News $news): JsonResponse
    {
        $images = $news->images()->get()->each(function (NewsImage &$image) {
            $image->path = asset($image->path);
        });
        return response()->json($images);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsImageRequest $request, News $news): JsonResponse
    {
        $imagePath = $request->file('image')->store('news_images', 'public');
        if (!$imagePath) {
            return response()->json(['error' => 'Failed to upload image'], 500); // Internal Server Error
        }

        /** @var NewsImage $image */
        $image = $news->images()->create(['path' => "storage/$imagePath"]);
        $image->path = asset($image->path); // Add the asset URL to the image object

        return response()->json($image); // Successful response
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsImage $newsImage): JsonResponse
    {
        $newsImage->path = asset($newsImage->path);
        return response()->json($newsImage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsImage $newsImage): JsonResponse
    {
        $newsImage->delete();
        return response()->json(['message' => 'Image deleted successfully']);
    }
}
