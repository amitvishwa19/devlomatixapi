<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
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

    public function login(Request $request)
    {

        //validate incoming request
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if ($token = $this->guard()->attempt($credentials)) {
            $user = auth()->user();
            return response()->json(['success' => true,'message'=>'Login success','token'=>$token], 200);
        }

        return response()->json(['success' => false,'message'=>'Invalid Credentials','token'=>null], 401);
    }

    public function user()
    {
        return response()->json($this->guard()->user(), 200);
        //return response()->json(auth()->user(),200));
    }

    public function guard()
    {
        return Auth::guard();
    }

    //
}
