<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display all users with their saved media collections.
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::with('media')->get());
    }

    /**
     * Display a single user with their saved media collection.
     */
    public function show(User $user): UserResource
    {
        $user->load('media');

        return new UserResource($user);
    }

    /**
     * Add a media item to the user's collection.
     */
    public function addToCollection(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'media_id' => ['required', 'exists:media,id'],
        ], [
            'media_id.required' => 'ID media wajib diisi.',
            'media_id.exists' => 'Media tidak ditemukan.',
        ]);

        if ($user->media()->where('media_id', $validated['media_id'])->exists()) {
            return response()->json([
                'message' => 'Media sudah ada di koleksi',
            ], 409);
        }

        $user->media()->attach($validated['media_id']);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi',
        ], 201);
    }

    /**
     * Remove a media item from the user's collection.
     */
    public function removeFromCollection(User $user, Media $media): JsonResponse
    {
        if (! $user->media()->where('media_id', $media->id)->exists()) {
            return response()->json([
                'message' => 'Media tidak ditemukan di koleksi pengguna',
            ], 404);
        }

        $user->media()->detach($media->id);

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi',
        ], 200);
    }
}
