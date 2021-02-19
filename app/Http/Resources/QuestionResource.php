<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'question'=>$this->question,
            'score'=>$this->score,
            'type'=>$this->type,
            'status'=>$this->status,
        ];
    }
}

