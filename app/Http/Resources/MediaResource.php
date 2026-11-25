<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'genre' => $this->genre,
            'episodes' => $this->episodes,
            'release_year' => $this->release_year,
            'rating' => $this->rating,
            'description' => $this->description,
            'users' => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
