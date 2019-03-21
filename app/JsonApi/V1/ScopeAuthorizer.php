<?php

namespace App\JsonApi\V1;

use CloudCreativity\LaravelJsonApi\Auth\AbstractAuthorizer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use App\JsonApi\V1\Users\Schema as UserSchema;
use App\JsonApi\V1\Profiles\Schema as ProfileSchema;
use App\JsonApi\V1\Education\Schema as EducationSchema;
use App\JsonApi\V1\Families\Schema as FamilySchema;
use App\Models\User;

class ScopeAuthorizer extends AbstractAuthorizer
{

    /**
     * Authorize a resource index request.
     *
     * @param string $type
     *      the domain record type.
     * @param Request $request
     *      the inbound request.
     * @return void
     * @throws AuthenticationException|AuthorizationException
     *      if the request is not authorized.
     */
    public function index($type, $request)
    {
        return $request->user()->tokenCan('be-trusted');
    }

    /**
     * Authorize a resource create request.
     *
     * @param string $type
     *      the domain record type.
     * @param Request $request
     *      the inbound request.
     * @return void
     * @throws AuthenticationException|AuthorizationException
     *      if the request is not authorized.
     */
    public function create($type, $request)
    {
        return $request->user()->tokenCan('be-trusted');
    }

    /**
     * Authorize a resource read request.
     *
     * @param object $record
     *      the domain record.
     * @param Request $request
     *      the inbound request.
     * @return void
     * @throws AuthenticationException|AuthorizationException
     *      if the request is not authorized.
     */
    public function read($record, $request)
    {
        // dump(!$request->user()->tokenCan('read-username-email'));
        if ($request->user()->tokenCan('be-trusted')) {
            return true;
        }
        if ($request->user()->tokenCan('read-username-email')) {
            return $this->can('view', $record);
        }
    }

    /**
     * Authorize a resource update request.
     *
     * @param object $record
     *      the domain record.
     * @param Request $request
     *      the inbound request.
     * @return void
     * @throws AuthenticationException|AuthorizationException
     *      if the request is not authorized.
     */
    public function update($record, $request)
    {
        return $request->user()->tokenCan('be-trusted');
    }

    /**
     * Authorize a resource read request.
     *
     * @param object $record
     *      the domain record.
     * @param Request $request
     *      the inbound request.
     * @return void
     * @throws AuthenticationException|AuthorizationException
     *      if the request is not authorized.
     */
    public function delete($record, $request)
    {
        return $request->user()->tokenCan('be-trusted');
    }

    /**
     * @override readRelationship AbstractAuthorizer]
     */
    public function readRelationship($record, $field, $request)
    {
        // dump($record);
        // dump($field);
        // dump($request->user()->tokenCan('read-basic-profile') && $field === 'profile');
        if ($request->user()->tokenCan('be-trusted')) {
            return true;
        }
        if ($request->user()->tokenCan('read-basic-profile') && $field === 'profile') {
            $this->can('view', $record);
        }
        if ($request->user()->tokenCan('read-education-profile') && $field === 'education') {
            $this->can('view', $record);
        }
        if ($request->user()->tokenCan('read-family-profile') && $field === 'family') {
            $this->can('view', $record);
        }
        // return false;
    }
    
}
