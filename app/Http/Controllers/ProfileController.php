<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Neomerx\JsonApi\Encoder\Encoder;
use App\Models\User;
use App\Http\Schemas\UserSchema;
use App\Models\Profile;
use App\Http\Schemas\ProfileSchema;
use App\Models\Education;
use App\Http\Schemas\EducationSchema;
use App\Models\Family;
use App\Http\Schemas\FamilySchema;

class ProfileController extends Controller
{
    public function show($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        // dd(
        $profile = $user->profile;
           // );
        $encoder = Encoder::instance([
            User::class => UserSchema::class,
            Profile::class => ProfileSchema::class,
            Education::class => EducationSchema::class,
            Family::class => FamilySchema::class,
        ])
        ->withUrlPrefix(url('/v1/users/'.$uuid))
        ->withEncodeOptions(JSON_PRETTY_PRINT);

        // return $encoder->encodeData($profile) . PHP_EOL;       
        return response($encoder->encodeData($profile), 200, ['Content-Type' => 'application/vnd.api+json']);
    }
}
