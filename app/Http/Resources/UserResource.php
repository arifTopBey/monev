<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'username' => $this->username,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'mobile_no' => $this->mobile_no,
            'email' => $this->email,
            'image' => $this->image ? Storage::url($this->image) : null,
            'role' => new RoleResource($this->role),
            'is_verify' => $this->is_verify,
            'is_admin' => $this->is_admin,
            'is_active' => $this->is_active,
            'is_supper' => $this->is_supper,
        ];
    }
}
