<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        if (!empty($req->all())) {
            $parser = new Parser($req->all());
            // dump($parser->getSorts());
            foreach ($parser->getIncludes() as $key => $value) {
                $included[] = $key;
            }
            foreach ($parser->getSorts() as $key => $value) {
                $temp = ['desc' => $value];
                $merged = [$key => $temp];
                // dump($merged);
                if (empty($sorts))
                    $sorts[] = $merged; 
                else
                    array_unshift($sorts, $merged);
                
                // dump($key,$value);
                // dump($sorts);
            }
            foreach ($parser->getFields() as $key => $value) {
                $fields[$key] = [];
                foreach ($value as $k => $v) {
                    array_push($fields[$key], $v);
                }
            }
        }
        // $users = DB::table('users')
        //         ->orderBy('name', 'desc')
        //         ->offset(10)
        //         ->limit(5)
                // ->get();
        $users = User::all();
        if (!empty($sorts)) {
            // // $users->newQuery();
            // $sorts = rsort($sorts);
            // dd($sorts);
            foreach ($sorts as $param) {
                foreach ($param as $key => $value) {
                    // dump($key,$value['desc']);
                    $users = ($value['desc']) ? $users->sortBy($key) : $users->sortByDesc($key) ;
                }
            }
            // $users->get();
            // $users = $users->sortBy(function($user) {
            //     return sprintf('%-12s%s', $user->username, $user->email);
            // });
            // $users = $users->values()->all();
            // $users = collect($users);
        }
        // foreach ($sorts as $key => $value) {
        //     // $sorted = ($value) ? $users->sortBy($key) : $users->sortByDesc($key) ;
        //     $users = ($value) ? $users->orderBy($key) : $users->orderBy($key, 'desc') ;
        //     $users->values();
        //     // dump($sorts);
        // }
        // return $sorted->values()->all();
        // dump($sorted);
        // dump($users);
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

        // dd($included);(array)$parser->getIncludes()
        $encoder = Encoder::instance([
            User::class => UserSchema::class,
            Profile::class => ProfileSchema::class,
            Education::class => EducationSchema::class,
            Family::class => FamilySchema::class,
        ]);
        if (!empty($included)) {
            // dump($included);
            $encoder = $encoder->withIncludedPaths($included);
        }
        if (!empty($fields)) {
          // dump($fields);
            $encoder = $encoder->withFieldSets($fields);
        }
        $result = $encoder
            ->withEncodeOptions(JSON_PRETTY_PRINT)
            ->withUrlPrefix(url('/v1'))
            ->withLinks($links)
            ->withMeta($meta)
            ->encodeData($users);
        
        return response($result, 200, ['Content-Type' => 'application/vnd.api+json']);
    }

    public function show($uuid, Request $req)
    {
        $user = User::where('uuid', $uuid)->first();

        // UserSchema::$isShowCustomLinks = false;
        // $encoder                       = Encoder::instance([
        //     User::class => UserSchema::class,
        //     Profile::class => ProfileSchema::class,
        //     Education::class => EducationSchema::class,
        //     Family::class => FamilySchema::class,
        // ])->withEncodeOptions(JSON_PRETTY_PRINT);

        // $result = $encoder
        //     ->withIncludedPaths([
        //         // Paths to be included. Note 'profile.family' will not be shown.
        //         'profile',
        //         'profile.education',
        //     ])
        //     ->withFieldSets([
        //         // Attributes and relationships that should be shown
        //         'users'  => ['username', 'profile'],
        //         'profile'  => ['education'],
        //         'education' => ['latest_major'],
        //     ])
        //     ->encodeData($user);
        $meta = [
            "copyright" => "Copyright 2019 PondokProgrammer Corp.",
            "authors" => "Students",
        ];
        if (!empty($req->all())) {
            $parser = new Parser($req->all());
            foreach ($parser->getIncludes() as $key => $value) {
                $included[] = $key;
            }
            foreach ($parser->getFields() as $key => $value) {
                $fields[$key] = [];
                foreach ($value as $k => $v) {
                    array_push($fields[$key], $v);
                }
            }
        }
        $encoder = Encoder::instance([
            User::class => UserSchema::class,
            Profile::class => ProfileSchema::class,
            Education::class => EducationSchema::class,
            Family::class => FamilySchema::class,
        ]);
        if (!empty($included)) {
            $encoder = $encoder->withIncludedPaths($included);
        }
        if (!empty($fields)) {
            $encoder = $encoder->withFieldSets($fields);
        }
        $result = $encoder
            ->withEncodeOptions(JSON_PRETTY_PRINT)
            ->withUrlPrefix(url('/v1'))
            // ->withLinks($links)
            ->withMeta($meta)
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
