<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function authenticateWithGoogle(Request $request){
        $googleToken = $request->header('Google-Access-Token');
        $googleResponse = json_decode(Http::get("https://www.googleapis.com/oauth2/v3/userinfo?access_token={$googleToken}"));
        if($googleResponse->email){
            $user = User::where('email',$googleResponse->email)->first();
            if(!$user){
                $role = Role::where('role','student')->first();
                $user = User::create([
                    "role_id"=>$role->id,
                    "name"=>$googleResponse->name,
                    "google_id"=>$googleResponse->sub,
                    "imgURL"=>$googleResponse->picture,
                    "email"=>$googleResponse->email,
                    "status"=>0
                ]);
            }
            $token = $user->createToken('Google Token')->accessToken;
            return response()->json(['access_token' => $token, "lifetime"=>3*24*60*60, 'google_id'=>$googleResponse->sub], 200);
        }else{
            return response()->json("Bad Access Token",401);
        }
    }
}
