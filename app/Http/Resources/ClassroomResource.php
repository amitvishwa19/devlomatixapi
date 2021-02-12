<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'user'=>[
                'firstName'=>$this->user->firstName,
                'lastName'=>$this->user->lastName,
                'avatar'=>$this->user->avatarUrl,
                'type'=>$this->user->type,
                'status'=>$this->user->status,
            ]
        ];
    }
}
