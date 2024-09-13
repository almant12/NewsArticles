<?php

namespace App\Http\Resources\Client;

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
          'id'=>$this->id,
            'title' => $this->title,
            'image' => $this->image,
            'description' => $this->description,
            'content' => $this->content,
            'published_at' => $this->published_at,
            'author' => $this->whenLoaded('author')
        ];
    }
}
