<?php

namespace App\JsonApi\V1;

use CloudCreativity\LaravelJsonApi\Auth\AbstractAuthorizer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Education;
use App\Models\Family;

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
        if ($request->user()->tokenCan('be-trusted')) {
            return true;
        }
        return false;
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
        if ($request->user()->tokenCan('be-trusted')) {
            return true;
        }
        return false;
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
        if ($request->user()->tokenCan('be-trusted')) {
            return true;
        }
        if ($request->user()->tokenCan('read-username-email') && $record instanceof User) {
            $this->can('read', $record);
        }
        if ($request->user()->tokenCan('read-basic-profile') && $record instanceof Profile) {
            $this->can('read', $record);
        }
        if ($request->user()->tokenCan('read-education-profile') && $record instanceof Education) {
            $this->can('read', $record);
        }
        if ($request->user()->tokenCan('read-family-profile') && $record instanceof Family) {
            $this->can('read', $record);
        }
        return false;
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
        if ($request->user()->tokenCan('be-trusted')) {
            return true;
        }
        return false;
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
        if ($request->user()->tokenCan('be-trusted')) {
            return true;
        }
        return false;
    }

}
