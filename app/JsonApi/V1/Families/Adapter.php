<?php

namespace App\JsonApi\V1\Families;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use App\JsonApi\V1\Pagination\DefaultStrategy;
use CloudCreativity\LaravelJsonApi\Eloquent\Concerns\SoftDeletesModels;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Adapter extends AbstractAdapter
{
    use SoftDeletesModels;
    protected $softDeleteField = 'trashed';
    protected $defaultPagination = ['number' => 1, 'size' => 10];

    /**
     * Mapping of JSON API attribute field names to model keys.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Adapter constructor.
     *
     * @param DefaultStrategy $paging
     */
    public function __construct(DefaultStrategy $paging)
    {
        parent::__construct(new \App\Models\Family(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        if ($living_parent = $filters->get('living_parent')) {
            $query->where('families.living_parent', 'like', "%{$living_parent}%");
        }

        if ($guardian = $filters->get('guardian')) {
            $query->where('families.guardian', 'like', "%{$guardian}%"); 
        }

        if ($parent_phone = $filters->get('parent_phone')) {
            $query->where('families.parent_phone', 'like', "%{$parent_phone}%");
        }

        if ($father_name = $filters->get('father_name')) {
            $query->where('families.father_name', 'like', "%{$father_name}%"); 
        }

        if ($mother_name = $filters->get('mother_name')) {
            $query->where('families.mother_name', 'like', "%{$mother_name}%");
        }

        if ($father_job = $filters->get('father_job')) {
            $query->where('families.father_job', 'like', "%{$father_job}%"); 
        }

        if ($mother_job = $filters->get('mother_job')) {
            $query->where('families.mother_job', 'like', "%{$mother_job}%");
        }

        if ($parent_income = $filters->get('parent_income')) {
            $query->where('families.parent_income', 'like', "%{$parent_income}%"); 
        }

        if ($total_sibling = $filters->get('total_sibling')) {
            $query->where('families.total_sibling', 'like', "%{$total_sibling}%");
        }

        if (true == $filters->get('with-trashed')) {
            $query->withTrashed();
        }

        if (true == $filters->get('only-trashed')) {
            $query->onlyTrashed();
        }
    }

}
