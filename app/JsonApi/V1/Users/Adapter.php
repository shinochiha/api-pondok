<?php

namespace App\JsonApi\V1\Users;

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
        parent::__construct(new \App\Models\User(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        if ($username = $filters->get('username')) {
            $query->where('users.username', 'like', "%{$username}%");
        }

        if ($email = $filters->get('email')) {
            $query->where('users.email', 'like', "%{$email}%"); 
        }

        if (true == $filters->get('with-trashed')) {
            $query->withTrashed();
        }

        if (true == $filters->get('only-trashed')) {
            $query->onlyTrashed();
        }
    }

    protected function profile()
    {
        return $this->hasOne();
    }

}
