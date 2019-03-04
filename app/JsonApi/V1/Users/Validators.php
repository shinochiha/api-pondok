<?php

namespace App\JsonApi\V1\Users;

use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;

class Validators extends AbstractValidators
{

    /**
     * The include paths a client is allowed to request.
     *
     * @var string[]|null
     *      the allowed paths, an empty array for none allowed, or null to allow all paths.
     */
    protected $allowedIncludePaths = ['profile', 'profile.education', 'profile.family'];

    /**
     * The sort field names a client is allowed send.
     *
     * @var string[]|null
     *      the allowed fields, an empty array for none allowed, or null to allow all fields.
     */
    protected $allowedSortParameters = ['username', 'email', 'created_at', 'updated at'];
    protected $allowedFilteringParameters = ['username', 'email', 'with-trashed', 'only-trashed'];
    protected $allowedPagingParameters = ['number', 'size'];

    /**
     * Get resource validation rules.
     *
     * @param mixed|null $record
     *      the record being updated, or null if creating a resource.
     * @return mixed
     */
    protected function rules($record = null): array
    {
        if (!empty($record)) {
            return [
                'username' => 'required',
                'email' => 'required',
                'password' => 'required',
                'trashed' => 'boolean',
                'profile.type' => 'in:profiles',
            ];
        }
        return [
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'profile.type' => 'in:profiles',
        ];
    }

    /**
     * Get query parameter validation rules.
     *
     * @return array
     */
    protected function queryRules(): array
    {
        return [
            'filter.username' => 'filled|string',
            'filter.email' => 'filled|string',
            'filter.with-trashed' => 'filled|boolean',
            'filter.only-trashed' => 'filled|boolean',
            'page.number' => 'integer|min:1',
            'page.size' => 'integer|between:1,100',
        ];
    }

}
