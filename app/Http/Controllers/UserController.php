<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;
use Neomerx\JsonApi\Schema\Link;
use App\Http\JsonApi\EncoderService;
use App\Models\User;

class UserController extends Controller
{
    protected $encoder;

    public function __construct(EncoderService $encoder)
    {
        $this->encoder = $encoder->getEncoder();
    }
    public function index(Request $req)
    {
        # Depth Pagination Filtering & Sorting
        // $users = DB::table('users')
        //         ->orderBy('name', 'desc')
        //         ->offset(10)
        //         ->limit(5)
                // ->get();
        // $isSubUrl = false;
        // $value = url('/v1/users?%s');
        // $hasMeta  = false;
        // $links    = [
        //     Link::FIRST => new Link($isSubUrl, sprintf($value, 'first'), $hasMeta),
        //     Link::LAST  => new Link($isSubUrl, sprintf($value, 'last'), $hasMeta),
        //     Link::PREV  => new Link($isSubUrl, sprintf($value, 'prev'), $hasMeta),
        //     Link::NEXT  => new Link($isSubUrl, sprintf($value, 'next'), $hasMeta),
        // ];
        $users = User::all();
        $encoder = $this->encoder;
        if (!empty($users)) $this->supportIndexFeatures($req, $users, $encoder);
        $result = $encoder
            // ->withLinks($links)
            ->encodeData($users);
        
        return response($result, 200, ['Content-Type' => 'application/vnd.api+json']);
    }

    public function show($uuid, Request $req)
    {
        $user = User::where('uuid', $uuid)->first();

        $encoder = $this->encoder;
        if (!empty($users)) $this->supportIndexFeatures($req, $user, $encoder);
        $result = $encoder->encodeData($user);
        
        return response($result, 200, ['Content-Type' => 'application/vnd.api+json']);
    }  
}
