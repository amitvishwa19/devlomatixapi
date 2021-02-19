<?php

namespace App\Http\Resources;

use App\Http\Resources\ClassroomResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    public function toArray($request)
    {

        $user =  auth()->user();
        $classrooms = $user->classrooms;

        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'userName' => $this->userName,
            'email' => $this->email,
            'avatar' => $this->avatar_url,
            'type' => $this->type,
            'status' => $this->status,
            'classrooms'=>ClassroomResource::collection($classrooms)
        ];
    }
}
