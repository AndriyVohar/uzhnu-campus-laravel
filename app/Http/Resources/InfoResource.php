<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource
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
            'dormitory'=>$this->dormitory,
            'created_at' => $this->created_at->setTimezone('Europe/Kiev')->format('d.m.y H:i'),
            // 'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
