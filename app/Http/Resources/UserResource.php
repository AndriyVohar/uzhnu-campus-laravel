<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'name' => $this->name,
            'imgURL' => $this->imgURL,
            'google_id' => $this->google_id,
            'dormitory' => $this->dormitory,
            'room' => $this->room,
            'phone' => $this->phone,
            'instagram'=>$this->instagram,
            'telegram'=>$this->telegram,
            'role'=>$this->role,
            'created_at' => $this->created_at->format('d.m.Y H:i')
        ];
    }
}
