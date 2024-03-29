<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkResource extends JsonResource
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
            'tag' => $this->tag,
            'imgURL' => $this->imgURL,
            'salary' => $this->salary,
            'description' => $this->description,
            'created_at' => $this->created_at->setTimezone('Europe/Kiev')->format('d.m.y'),
            'status'=> $this->status
            // 'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
