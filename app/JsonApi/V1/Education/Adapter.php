<?php

namespace App\JsonApi\V1\Education;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use App\JsonApi\V1\Pagination\DefaultStrategy;
use CloudCreativity\LaravelJsonApi\Eloquent\Concerns\SoftDeletesModels;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

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
        parent::__construct(new \App\Models\Education(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        if ($pre_elementary = $filters->get('pre_elementary')) {
            $query->where('families.pre_elementary', 'like', "%{$pre_elementary}%");
        }

        if ($elementary = $filters->get('elementary')) {
            $query->where('families.elementary', 'like', "%{$elementary}%"); 
        }

        if ($junior_high = $filters->get('junior_high')) {
            $query->where('families.junior_high', 'like', "%{$junior_high}%");
        }

        if ($senior_high = $filters->get('senior_high')) {
            $query->where('families.senior_high', 'like', "%{$senior_high}%"); 
        }

        if ($other_education = $filters->get('other_education')) {
            $query->where('families.other_education', 'like', "%{$other_education}%");
        }

        if ($latest_major = $filters->get('latest_major')) {
            $query->where('families.latest_major', 'like', "%{$latest_major}%"); 
        }

        if (true == $filters->get('with-trashed')) {
            $query->withTrashed();
        }

        if (true == $filters->get('only-trashed')) {
            $query->onlyTrashed();
        }
    }

}
