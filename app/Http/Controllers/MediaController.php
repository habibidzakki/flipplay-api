<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MediaController extends Controller
{
    /**
     * Display a paginated listing of media, optionally filtered by title.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Media::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        return MediaResource::collection($query->paginate(10));
    }

    /**
     * Store a newly created media item.
     */
    public function store(StoreMediaRequest $request): JsonResponse
    {
        $media = Media::create($request->validated());
        $media->refresh();

        return (new MediaResource($media))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified media along with users who saved it.
     */
    public function show(Media $media): MediaResource
    {
        $media->load('users');

        return new MediaResource($media);
    }

    /**
     * Update the specified media item.
     */
    public function update(UpdateMediaRequest $request, Media $media): JsonResponse
    {
        $media->update($request->validated());

        return (new MediaResource($media))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified media item from storage.
     */
    public function destroy(Media $media): JsonResponse
    {
        $media->delete();

        return response()->json([
            'message' => 'Media berhasil dihapus',
        ], 200);
    }
}
