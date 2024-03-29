<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->put('user', $credentials);
                Session::flash('success', 'Login Successfully');
            return redirect()->intended('/');

        } else {
            return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
        }
    }


    public function register(Request $request)
    {
        try {

            $validate = $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'mobile_number' => 'required|min:10'
            ]);

            $user = User::where(['email' => $request->email])->first();
            $mobileExist = User::where(['mobile_number' => $request->mobile_number])->first();

            if ($user) {
                return response()->json(["status" => 403, "message" => "Email Already Exist", "data" => []], 403);
            }

            if ($mobileExist) {
                return response()->json(["status" => 403, "message" => "Mobile number already exist", "data" => []], 403);
            }

            $path = '';


            if ($request->file('profile_image')) {

                $image = $request->file('profile_image');
                $path = $image->store('images', 'public');
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'profile_image' => $path,
                'mobile_number' => $request->mobile_number,
                'password' =>  $request->password,
                'fcm_token'=>''
            ]);
            return response()->json(["status" => 200, "message" => "Register Successfully!", "data" => []], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    public function login(Request $request)
    {

        try {
            $validate = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (!$token = auth('api')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json(["status" => 401, "message" => "Invalid Credentails", "data" => []], 401);
            }

            return response()->json(["status" => 200, "message" => "Login Successfully", "data" => auth('api')->user(), "token" => $this->respondWithToken($token)], 200);
        } catch (Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
        }
    }

    protected function respondWithToken($token)
    {
        # This function is used to make JSON response with newtoke
        # access token of current user
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    // public function me(Request $request)
    // {

    //     try {

    //         return response()->json(["status" => 200, "message" => "Login Successfully", "data" => auth()->user()], 200);

    //     } catch (Exception $e) {
    //         return response()->json(["status" => 500, "message" => $e->getMessage(), "data" => []], 500);
    //     }

    // }



}
