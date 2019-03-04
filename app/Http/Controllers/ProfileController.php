<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\JsonApi\EncoderService;
use App\Models\User;

class ProfileController extends Controller
{
    protected $encoder;

    public function __construct(EncoderService $encoder)
    {
        $this->encoder = $encoder->getEncoder();
    }
    public function show($uuid, Request $req)
    {
        $user = User::where('uuid', $uuid)->first();
        // dd(
        $profile = $user->profile;
           // );
        $encoder = $this->encoder;
        if (!empty($profile)) $this->supportIndexFeatures($req, $profile, $encoder);
        $result = $encoder->encodeData($profile);
        
        return response($result, 200, ['Content-Type' => 'application/vnd.api+json']);
    }
}
