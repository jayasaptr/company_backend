<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid Credential'
            ], 401);
        }

        //check password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid Credential'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login Success',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Logout Success'], 200);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'face_embeding' => 'required',
        ]);

        $user = $request->user();
        $face_embeding = $request->face_embeding;
        $user->face_embeding = $face_embeding;
        $user->save();

        return response([
            'message' => 'Profile updated',
            'user' => $user,
        ], 200);
    }

    public function isValidFace(Request $request)
    {
        $emb = $request->input('emb');

        $users = User::whereNotNull('face_embeding')->get();
        foreach ($users as $user) {
            $faceEmbedding = array_map('doubleval', explode(',', $user->face_embeding));

            $distance = $this->findNearest($emb, $faceEmbedding);
            
            if ($distance < 1.0) {
                return response()->json(['valid' => true, 'user' => $user]);
            }
        }

        return response()->json(['valid' => false]);
    }

    private function findNearest(array $emb, array $authFaceEmbedding)
    {
        $distance = 0;
        $count = min(count($emb), count($authFaceEmbedding));
        for ($i = 0; $i < $count; $i++) {
            $diff = $emb[$i] - $authFaceEmbedding[$i];
            $distance += $diff * $diff;
        }
        return sqrt($distance);
    }
}

class PairEmbedding
{
    public $distance;

    public function __construct($distance)
    {
        $this->distance = $distance;
    }
}
