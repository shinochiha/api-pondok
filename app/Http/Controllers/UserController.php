<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class UserController extends Controller
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

    //
    public function index()
    {
        $users = User::paginate(5);
        
        return response()->json(['data' => $users], 200);
    }

    //
    public function store(Request $request)
    {
        // Validation
        $this->validate($request,[
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = new User();
        // Generate UUID
        $user->uuid = Uuid::generate(4);

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return $this->success("Create success", 201);
    }

    //
    public function show($id)
    {
        $user = User::findOrFail($id);

        $data = [
            'full_name' => $user->profile->full_name,
            'birth_place' => $user->profile->birth_place,
            'birth_date' => $user->profile->birth_data
        ];

        return response()->json($user, 200);
    }

    //
    public function update($id)
    {

    }

    //
    public function destroy($id)
    {

    }

    // Don`t Repeat your code
    protected function success($data, $code)
    {
        return response()->json(['data' => $data], $code);
    }

    // Don`t Repeat your code
    protected function error($message, $code)
    {
        return response()->json(['message' => $message], $code);
    }
}
