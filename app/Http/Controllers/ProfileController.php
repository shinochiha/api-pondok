<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
        $profile = User::paginate(5);

        return response()->json(['data' => $profile], 200);
    }

    public function store(Request $request)
    {
        $profile = new Profile();

        $profile->user_id = user()->id;
        dd($profile);
    }

}
