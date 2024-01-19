<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
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
            'creator'=>new UserPublicInfoResource($this->creator),
            'created_at' => $this->created_at->setTimezone('Europe/Kiev')->format('d.m.y H:i')
        ];
    }
}
