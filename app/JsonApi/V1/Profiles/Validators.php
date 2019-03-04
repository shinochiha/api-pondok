<?php

namespace App\JsonApi\V1\Profiles;

use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;

class Validators extends AbstractValidators
{

    /**
     * The include paths a client is allowed to request.
     *
     * @var string[]|null
     *      the allowed paths, an empty array for none allowed, or null to allow all paths.
     */
    protected $allowedIncludePaths = ['education', 'family'];

    /**
     * The sort field names a client is allowed send.
     *
     * @var string[]|null
     *      the allowed fields, an empty array for none allowed, or null to allow all fields.
     */
    protected $allowedSortParameters = ['fullname'];
    protected $allowedFilteringParameters = ['fullname', 'gender', 'birth_place', 'birth_date', 'address', 'city', 'province', 'phone', 'wa', 'fb', 'hobby', 'dream', 'idol', 'quran', 'with-trashed', 'only-trashed'];
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
        return [
            'fullname' => 'required|regex:/[A-Za-z][A-Za-z\.\s]+/',
            'gender'  => 'required|in:male,female',
            'birth_place'  => 'required|alpha',
            'birth_date'  => 'required|before:yesterday',
            'address'  => 'required',
            'city'  => 'required',
            'province'  => 'required',
            'phone' => 'required',
            'wa'  => 'required',
            'fb'  => 'required',
            'hobby'  => 'required',
            'dream'  => 'required',
            'idol'  => 'required',
            'quran'  => 'required|numeric',
            'photo'  => 'required',
            'education.type' => 'in:education',
            'family.type' => 'in:families',
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
            'filter.fullname' => 'filled|alpha',
            'filter.gender' => 'filled|in:male,female',
            'filter.birth_place' => 'filled|alpha',
            'filter.birth_date' => 'filled',
            'filter.address' => 'filled|string',
            'filter.city' => 'filled|alpha',
            'filter.province' => 'filled|alpha',
            'filter.phone' => 'filled|numeric',
            'filter.wa' => 'filled|numeric',
            'filter.fb' => 'filled|string',
            'filter.hobby' => 'filled|alpha',
            'filter.dream' => 'filled|string',
            'filter.idol' => 'filled|string',
            'filter.quran' => 'filled|numeric',
            'filter.with-trashed' => 'filled|boolean',
            'filter.only-trashed' => 'filled|boolean',
            'page.number' => 'integer|min:1',
            'page.size' => 'integer|between:1,100',
        ];
    }

}
