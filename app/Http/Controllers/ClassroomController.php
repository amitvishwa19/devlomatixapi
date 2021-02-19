<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classroom;
use App\Http\Resources\TestResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\ClassroomResource;

class ClassroomController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $user =  auth()->user();
        $classrooms = $user->classrooms;

        $classroom = Classroom::findOrFail(10);
        $chapters = $classroom->chapters;
        // foreach($classrooms as $classroom){
        //     return $classroom->chapters;
        // }

        return new TestResource(auth()->user());
        $classrooms = $user->classrooms;
        //return response()->json(new ClassroomResource($user), 200);
        return response()->json(ClassroomResource::collection($classrooms), 200);
    }

    //
}
