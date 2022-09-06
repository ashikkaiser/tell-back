<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $check = User::where('email', $request->email)->exists();
        if ($check) {
            $status = User::where('email', $request->email)->first()->status;
            if ($status == 'pending') {
                if ($token = $this->guard()->attempt($credentials)) {
                    return $this->respondWithToken($token);
                }
            } else {
                return response()->json(['message' => 'Unauthorized', 'type' => 'message'], 401);
            }
        }

        return response()->json(['message' => 'Unauthorized', 'type' => 'message'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $this->validate($request, [
            'account_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country_id' => 'required',
            'zip' => 'required',
            'phone' => 'required',
        ]);
        $user = new User();
        $user->account_type = $request->account_type;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->im = json_encode([
            'type' => $request->instantMessangerType,
            'name' => $request->instantMessenger,
        ]);
        $user->password = Hash::make($request->password);
        $user->fb_link = $request->fb_link;
        $user->web_link = $request->web_link;
        $user->address1 = $request->address1;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country_id = $request->country_id;
        $user->zip = $request->zip;
        $user->phone = $request->phone;
        $user->package_id = $request->package_id;
        $user->status = 'pending';
        $user->is_admin = false;
        if ($user->save()) {
            $workspace = new Workspace();
            $workspace->user_id = $user->id;
            $workspace->name = "Public Workspace";
            $workspace->save();
            loadColumns($user->id);
        }
        return response()->json([
            'success' => true,
            'message' => 'Registration Successfully',
        ]);
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->account_type = $request->account_type;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->im = json_encode([
            'type' => $request->instantMessangerType,
            'name' => $request->instantMessenger,
        ]);
        $user->password = Hash::make($request->password);
        $user->fb_link = $request->fb_link;
        $user->web_link = $request->web_link;
        $user->address1 = $request->address1;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country_id = $request->country_id;
        $user->zip = $request->zip;
        $user->phone = $request->phone;
        $user->package_id = $request->package_id;
        $user->status = 'pending';
        $user->is_admin = false;
        if ($user->save()) {
            $workspace = new Workspace();
            $workspace->user_id = $user->id;
            $workspace->name = "Public Workspace";
            $workspace->save();
            loadColumns($user->id);
        }
        return response()->json([
            'success' => true,
            'message' => 'Registration Successfully',
        ]);
    }

    public function countries()
    {
        $countries = Country::all();
        return response()->json([
            'data' => $countries
        ]);
    }

    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => $this->guard()->user(),
            'workspaces' => Workspace::where('user_id', auth()->user()->id)->get(),
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
