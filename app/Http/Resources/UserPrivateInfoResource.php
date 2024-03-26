<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Role;

class UserPrivateInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $role = Role::where('id',$this->role_id)->first();
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
            'role'=>$role->role,
            'created_at' => $this->created_at->setTimezone('Europe/Kiev')->format('d.m.y H:i'),
            'status'=>$this->status
        ];
    }
}
