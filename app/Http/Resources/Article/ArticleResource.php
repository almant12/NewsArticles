<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'image' => $this->image,
            'description' => $this->description,
            'content' => $this->content,
            'published_at' => $this->published_at->toDateTimeString(),
            'author' => $this->whenLoaded('author')
        ];
    }
}
