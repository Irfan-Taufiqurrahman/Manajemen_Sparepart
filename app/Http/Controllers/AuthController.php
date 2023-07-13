<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // use AuthenticatesUsers;

    // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function showRegistrationForm()
    {
        return view('auth/register');
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function indexUsers()
    {
        //get all users
        $users = User::all();

        return response()->json($users);
    }

    public function registerAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number_phone' => 'required|min:9|max:15|unique:users',
            'name' => 'required',
            'role' => 'required|integer',
            'password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fails',
                'error' => $validator->errors(),
            ], 422);
        }
        $user = User::create([
            'number_phone' => $request->number_phone,
            'name' => $request->name,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Add User Success',
            'data' => $user,
        ], 200);
    }

    //start of function edit
    public function updateAdmin(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'confirmation' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        $user->update([
            'confirmation' => $request->confirmation,
        ]);

        return response()->json([
            'message' => 'Confirmation updated',
            'data' => $user,
        ], 200);
    }
    //end of function edit

    public function deleteAdmin($id)
    {
        try {
            $user = User::find($id);
            return $user->delete();
            return ResponseFormatter::success([
                'message' => 'User deleted succesfull',
            ], 'User deleted succesfull', 500);
        } catch (QueryException $error) {
            return ResponseFormatter::error([
                'message' => 'something went wrong',
                'error' => $error,
            ], 'User not deleted', 500);
        }
    }

    // //start of function register with API
    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'number_phone' => 'required|min:9|max:15|unique:users',
    //         'name' => 'required',
    //         'password' => 'required|min:6|max:100',
    //         'confirm_password' => 'required|same:password',
    //         // 'confirmed' => false,
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => 'Validation',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $user = User::create([
    //         'number_phone' => $request->number_phone,
    //         'name' => $request->name,
    //         // 'role_id' => 2, // Assign role_id to 2
    //         'password' => Hash::make($request->password),
    //     ]);

    //     return response()->json([
    //         'message' => 'Registration successful',
    //         'data' => $user,
    //     ], 200);
    // }
    // //end of function register

    //start of function register with Session
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number_phone' => 'required|min:9|max:15|unique:users',
            'name' => 'required',
            'password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:password',
            // 'confirmed' => false,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'number_phone' => $request->number_phone,
            'name' => $request->name,
            'role_id' => 2, // Assign role_id to 2
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('auth.loginIndex')->with('success', 'berhasil register');
        // return response()->json([
        //     'message' => 'Registration successful',
        //     'data' => $user,
        // ], 200);
    }
    //end of function register with Session

    //Start of function of login with API (TOKEN)
    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'number_phone' => 'required|min:9|max:15',
    //         'password' => 'required|min:6|max:100',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => 'Validation',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $user = User::where('number_phone', $request->number_phone)->first();

    //     if (!$user) {
    //         return response()->json([
    //             'message' => 'Invalid Credentials',
    //         ], 401);
    //     }

    //     if (!Hash::check($request->password, $user->password)) {
    //         return response()->json([
    //             'message' => 'Invalid Credentials',
    //         ], 401);
    //     }

    //     if (!$user->confirmed) {
    //         throw new \Exception('Your account has not been confirmed yet');
    //     }

    //     $tokenResult = $user->createToken('user login')->plainTextToken;

    //     return response()->json([
    //         'message' => 'Successfully Logged in',
    //         'token' => $tokenResult,
    //         'user' => $user,
    //     ], 200);
    // }

    //login with session
    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'number_phone' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('number_phone' => $input['number_phone'], 'password' => $input['password']))) {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('home.index');
            } else if (auth()->user()->role == 'pengawas') {
                return redirect()->route('home.index');
            } else {
                return redirect()->route('home.index');
            }
        } else {
            return redirect()
                ->route('login')
                ->with('error', 'Incorrect number_phone or password!.');
        }
    }

    //End of function of login

    public function me(Request $request)
    {
        return response()->json([
            'user' => auth()->user()
        ], 200);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
