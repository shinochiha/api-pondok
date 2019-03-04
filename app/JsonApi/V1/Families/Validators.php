<?php

namespace App\JsonApi\V1\Families;

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
    protected $allowedFilteringParameters = ['living_parent', 'guardian', 'parent_phone', 'father_name', 'mother_name', 'father_job', 'mother_job', 'parent_income', 'total_sibling', 'with-trashed', 'only-trashed'];
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
            'living_parent' => 'required|numeric',
            'guardian'  => 'required|regex:/[A-Za-z][A-Za-z\.\s]+/',
            'parent_phone'  => 'required',
            'father_name'  => 'required|regex:/[A-Za-z][A-Za-z\.\s]+/',
            'mother_name'  => 'required|regex:/[A-Za-z][A-Za-z\.\s]+/',
            'father_job'  => 'required|regex:/[A-Za-z][A-Za-z\.\s]+/',
            'mother_job'  => 'required|regex:/[A-Za-z][A-Za-z\.\s]+/',
            'parent_income'  => 'required',
            'total_sibling'  => 'required|numeric',            
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
            'filter.living_parent' => 'filled|numeric',
            'filter.guardian' => 'filled|regex:/[A-Za-z][A-Za-z\.\s]+/',
            'filter.parent_phone' => 'filled|numeric',
            'filter.father_name'  => 'filled|regex:/[A-Za-z][A-Za-z\.\s]+/',
            'filter.mother_name'  => 'filled|regex:/[A-Za-z][A-Za-z\.\s]+/',
            'filter.father_job'  => 'filled|regex:/[A-Za-z][A-Za-z\.\s]+/',
            'filter.mother_job'  => 'filled|regex:/[A-Za-z][A-Za-z\.\s]+/',
            'filter.parent_income'  => 'filled',
            'filter.total_sibling'  => 'filled|numeric',
            'filter.with-trashed' => 'filled|boolean',
            'filter.only-trashed' => 'filled|boolean',
            'page.number' => 'integer|min:1',
            'page.size' => 'integer|between:1,100',
        ];
    }
}
