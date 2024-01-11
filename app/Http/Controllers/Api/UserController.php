<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\AdvertisementResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $response = User::where('google_id', $request->google_id)->first();
        if($response){
            return response($response,201);
        }else {
            $user = User::create($request->all());
            return response($user,201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::where('google_id', $id)->first();
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::where('google_id', $id)->first();
        $user->update($request->all());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::where('google_id', $id)->first();
        $user->delete();

        return response()->json('', 204);
    }
    public function getUserAdvertisements($id) {
        $user = User::where('google_id', $id)->first();
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        $advertisements = $user->advertisements;

        return $advertisements;
    }
}
