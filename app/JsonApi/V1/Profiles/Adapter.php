<?php

namespace App\JsonApi\V1\Profiles;

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
        parent::__construct(new \App\Models\Profile(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        if ($fullname = $filters->get('fullname')) {
            $query->where('profiles.fullname', 'like', "%{$fullname}%");
        }

        if ($gender = $filters->get('gender')) {
            $query->where('profiles.gender', 'like', "%{$gender}%"); 
        }

        if ($birth_place = $filters->get('birth_place')) {
            $query->where('profiles.birth_place', 'like', "%{$birth_place}%");
        }

        if ($birth_date = $filters->get('birth_date')) {
            $query->where('profiles.birth_date', 'like', "%{$birth_date}%"); 
        }

        if ($address = $filters->get('address')) {
            $query->where('profiles.address', 'like', "%{$address}%");
        }

        if ($city = $filters->get('city')) {
            $query->where('profiles.city', 'like', "%{$city}%");
        }

        if ($province = $filters->get('province')) {
            $query->where('profiles.province', 'like', "%{$province}%"); 
        }

        if ($phone = $filters->get('phone')) {
            $query->where('profiles.phone', 'like', "%{$phone}%");
        }

        if ($wa = $filters->get('wa')) {
            $query->where('profiles.wa', 'like', "%{$wa}%"); 
        }

        if ($fb = $filters->get('fb')) {
            $query->where('profiles.fb', 'like', "%{$fb}%");
        }

        if ($hobby = $filters->get('hobby')) {
            $query->where('profiles.hobby', 'like', "%{$hobby}%"); 
        }

        if ($dream = $filters->get('dream')) {
            $query->where('profiles.dream', 'like', "%{$dream}%");
        }

        if ($idol = $filters->get('idol')) {
            $query->where('profiles.idol', 'like', "%{$idol}%");
        }

        if ($quran = $filters->get('quran')) {
            $query->where('profiles.quran', 'like', "%{$quran}%");
        }

        if (true == $filters->get('with-trashed')) {
            $query->withTrashed();
        }

        if (true == $filters->get('only-trashed')) {
            $query->onlyTrashed();
        }
    }

    protected function education()
    {
        return $this->hasOne();
    }

    protected function family()
    {
        return $this->hasOne();
    }

}
