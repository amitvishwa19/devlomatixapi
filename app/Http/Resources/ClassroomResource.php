<?php

namespace App\Http\Resources;

use App\Models\Classroom;
use App\Http\Resources\ChapterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    public function toArray($request)
    {
        $classroom = Classroom::findOrFail($this->id);
        $chapters = $classroom->chapters;
        return [

                    'id' => $this->id,
                    'code' => $this->classroom_code,
                    'name' => $this->name,
                    'description' => $this->description,
                    'status' => $this->status,
                    'chapters'=>ChapterResource::collection($chapters)

        ];
    }
}

// 'user'=>[
//     'id'=>$this->user->id,
//     'firstName'=>$this->user->firstName,
//     'lastName'=>$this->user->lastName,
//     'avatar'=>$this->user->avatarUrl,
//     'type'=>$this->user->type,
//     'status'=>$this->user->status,
//     'classrooms'=>[
//         'id' => $this->id,
//         'code' => $this->classroom_code,
//         'name' => $this->name,
//         'description' => $this->description,
//         'status' => $this->status,
//         'chapters'=>[
//             'id'=>$this->id,
//             'quizs'=>[
//                 'questions'=>[

//                 ]
//             ]
//         ]
//     ]
// ],
