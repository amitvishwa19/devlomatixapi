<?php

namespace App\Http\Resources;

use App\Models\Chapter;
use App\Http\Resources\QuizResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
{
    public function toArray($request)
    {
        $chapter = Chapter::findOrFail($this->id);
        $quizs = $chapter->quizs;
        return [
            'name'=>$this->name,
            'description'=>$this->description,
            'feature_image'=>$this->feature_image,
            'content'=>$this->content,
            'free'=>$this->free,
            'price'=>$this->price,
            'status'=>$this->status,
            'quizs'=>QuizResource::collection($quizs)
        ];
    }
}

