<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
   
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->admin_role_title,
            'status' => $this->admin_role_status
        ];
    }
}
