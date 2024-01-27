<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsImageRequest;
use App\Http\Requests\UpdateNewsImageRequest;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Http\Request;

class NewsImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(News $news): \Illuminate\Http\JsonResponse
    {
        $images = $news->images()->get()->each(function (NewsImage &$image) {
            $image->path = asset($image->path);
        });
        return response()->json($images, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsImage $newsImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsImage $newsImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsImageRequest $request, NewsImage $newsImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsImage $newsImage)
    {
        //
    }
}
