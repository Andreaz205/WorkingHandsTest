<?php

namespace App\Http\Resources\Api\Application;

use App\DTO\CourseItemDTO;
use App\Http\Resources\Api\Course\CourseResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginatedApplicationResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'link' => $this->mainLink->link,
        ];
    }
}
