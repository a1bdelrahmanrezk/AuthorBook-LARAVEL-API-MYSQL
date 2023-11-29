<?php

namespace Modules\Author\app\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Book\app\Resources\BookResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            "books" => BookResource::collection($this->whenLoaded('books')),
        ];
    }
}
