<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @mixin \App\Models\Task
 */
#[OA\Schema(
    properties: [
        new OA\Property(property: 'id', example: '2'),
        new OA\Property(property: 'title', example: 'Title'),
        new OA\Property(property: 'description', example: 'Description'),
        new OA\Property(property: 'status', format: 'string', example: 'planned'),
    ]
)]
final class TaskResource extends JsonResource
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
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
