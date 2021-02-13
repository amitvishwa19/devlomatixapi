<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\File;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
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

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function user()
    {
        return response()->json($this->guard()->user(), 200);
        //$user = new UserResource($this->guard()->user());
        //return response()->json($user, 200);
    }

    public function user_update(Request $request){

        //return $request->file('avatar');
        //$user = new UserResource($this->guard()->user());
        //return response()->json($user, 200);
        $user = $this->guard()->user();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->type = $request->type;

        if($request->avatar == 'remove'){
            $user->avatar_url = null;
        }

        if($request->file('avatar')){
            //$avatar_url = uploadImage($request->file('avatar'));
            //$user->avatar_url = $avatar_url;

            $image_name = time().'_'.$request->file('avatar')->getClientOriginalName();
            $destinationPath =  app()->basePath('public/uploads/avatars');
            $request->file('avatar')->move($destinationPath, $image_name);
            return url($destinationPath);


        }

        $user->update();
        return response()->json(new UserResource($this->guard()->user()), 200);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        //return $this->respondWithToken(auth()->refresh());
        $refresh_token = auth()->refresh();

        if ($refresh_token ) {
            return response()->json(['success' => true,'message'=>'token refreshed succesfully','token'=>$refresh_token], 200);
        }

        return response()->json(['success' => false,'message'=>'token refresh failed','token'=>null], 401);

    }

    public function guard()
    {
        return Auth::guard();
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    //
}
