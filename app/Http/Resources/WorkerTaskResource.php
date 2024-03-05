<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkerTaskResource extends JsonResource
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
            'description'=>$this->description,
            'creator' => new UserDormitoryInformationResource($this->creator),
            'created_at'=>$this->created_at->setTimezone('Europe/Kiev')->format('d.m.y H:i'),
        ];
    }
}
