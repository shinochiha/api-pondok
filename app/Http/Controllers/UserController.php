<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;
use Neomerx\JsonApi\Encoder\Encoder;
use Neomerx\JsonApi\Schema\Link;
use Neomerx\JsonApi\Http\Query\BaseQueryParser as Parser;
use App\Models\User;
use App\Http\Schemas\UserSchema;
use App\Models\Profile;
use App\Http\Schemas\ProfileSchema;
use App\Models\Education;
use App\Http\Schemas\EducationSchema;
use App\Models\Family;
use App\Http\Schemas\FamilySchema;

class UserController extends Controller
{
    public function index(Request $req)
    {
        $user = User::all();
        // if (empty($req->fields))
        // dd(json_decode($req->all(), true));
        $meta = [
            "copyright" => "Copyright 2019 PondokProgrammer Corp.",
            "authors" => "Students",
        ];
        $isSubUrl = false;
        $value = url('/v1/users?%s');
        $hasMeta  = false;
        $links    = [
            Link::FIRST => new Link($isSubUrl, sprintf($value, 'first'), $hasMeta),
            Link::LAST  => new Link($isSubUrl, sprintf($value, 'last'), $hasMeta),
            Link::PREV  => new Link($isSubUrl, sprintf($value, 'prev'), $hasMeta),
            Link::NEXT  => new Link($isSubUrl, sprintf($value, 'next'), $hasMeta),
        ];
        // $included=[];
        if (!empty($req->all())) {
            $parser = new Parser($req->all());
            foreach ($parser->getIncludes() as $key => $value) {
                $included[] = $key;
            }
            foreach ($parser->getFields() as $key => $value) {
                $fields[$key] = $value;
            }
        }
        // dd($included);(array)$parser->getIncludes()
        $encoder = Encoder::instance([
            User::class => UserSchema::class,
            Profile::class => ProfileSchema::class,
            Education::class => EducationSchema::class,
            Family::class => FamilySchema::class,
        ]);
        if (!empty($included)) {
            $encoder->withIncludedPaths($included);
        }
        if (!empty($fields)) {
            $encoder->withFieldSets($fields);
        }
        $result = $encoder
            ->withEncodeOptions(JSON_PRETTY_PRINT)
            ->withUrlPrefix(url('/v1'))
            ->withLinks($links)
            ->withMeta($meta)
            ->encodeData($user);
        
        return response($result, 200, ['Content-Type' => 'application/vnd.api+json']);
    }

    public function show($uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        // UserSchema::$isShowCustomLinks = false;
        $encoder                       = Encoder::instance([
            User::class => UserSchema::class,
            Profile::class => ProfileSchema::class,
            Education::class => EducationSchema::class,
            Family::class => FamilySchema::class,
        ])->withEncodeOptions(JSON_PRETTY_PRINT);

        $result = $encoder
            ->withIncludedPaths([
                // Paths to be included. Note 'profile.family' will not be shown.
                'profile',
                'profile.education',
            ])
            ->withFieldSets([
                // Attributes and relationships that should be shown
                'users'  => ['name', 'profile'],
                'profile'  => ['education'],
                'education' => ['latest_major'],
            ])
            ->encodeData($user);

        // return $result;
        // $encoder = Encoder::instance([
        //     User::class => UserSchema::class,
        // ])$encoder->encodeData($user)
        // ->withUrlPrefix(url('/v1'))
        // ->withEncodeOptions(JSON_PRETTY_PRINT);
        
        return response($result, 200, ['Content-Type' => 'application/vnd.api+json']);
    }  
}
