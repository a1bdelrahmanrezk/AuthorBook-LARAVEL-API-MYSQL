<?php

namespace Modules\Book\app\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Author\app\Resources\AuthorResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'authors' => AuthorResource::collection($this->whenLoaded('authors')),
        ];
    }
}
