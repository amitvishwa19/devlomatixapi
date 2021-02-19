<?php

namespace App\Http\Resources;

use App\Models\Quiz;
use App\Http\Resources\QuestionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    public function toArray($request)
    {
        $quiz = Quiz::findOrFail($this->id);
        $questions = $quiz->questions;
        return [
            'name'=>$this->name,
            'description'=>$this->description,
            'feature_image'=>$this->feature_image,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'notice_published'=>$this->notice_published,
            'result_published'=>$this->result_published,
            'status'=>$this->status,
            'questions'=>QuestionResource::collection($questions)
        ];
    }
}

