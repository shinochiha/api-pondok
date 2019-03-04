<?php

namespace App\JsonApi\V1\Education;

use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;

class Validators extends AbstractValidators
{

    /**
     * The include paths a client is allowed to request.
     *
     * @var string[]|null
     *      the allowed paths, an empty array for none allowed, or null to allow all paths.
     */
    protected $allowedIncludePaths = [];

    /**
     * The sort field names a client is allowed send.
     *
     * @var string[]|null
     *      the allowed fields, an empty array for none allowed, or null to allow all fields.
     */
    protected $allowedSortParameters = null;
    protected $allowedFilteringParameters = ['pre_elementary', 'elementary', 'junior_high', 'senior_high', 'other_education', 'latest_major', 'with-trashed', 'only-trashed'];
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
            'pre_elementary' => 'alpha_dash',
            'elementary'  => 'alpha_dash',
            'junior_high'  => 'alpha_dash',
            'senior_high'  => 'alpha_dash',
            'other_education'  => 'alpha_dash',
            'latest_major'  => 'alpha_dash',
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
            'filter.pre_elementary' => 'filled|alpha_dash',
            'filter.elementary' => 'filled|alpha_dash',
            'filter.junior_high' => 'filled|alpha_dash',
            'filter.senior_high' => 'filled|alpha_dash',
            'filter.other_education' => 'filled|alpha_dash',
            'filter.latest_major' => 'filled|alpha_dash',
            'filter.with-trashed' => 'filled|boolean',
            'filter.only-trashed' => 'filled|boolean',
            'page.number' => 'integer|min:1',
            'page.size' => 'integer|between:1,100',
        ];
    }

}
