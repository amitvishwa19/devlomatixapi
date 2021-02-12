<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
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
        $user = auth()->user();

        $classrooms = $user->clasrooms;
        //return $classrooms;

        $classrooms = Classroom::with('user')->get();
        //return $classrooms;
        return response()->json(ClassroomResource::collection($classrooms), 200);


        //$user = auth()->user();
        //return $user;
    }

    //
}
