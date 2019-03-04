<?php

namespace App\JsonApi\V1\Families;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'families';

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'living_parent' => $resource->living_parent,
            'guardian'  => $resource->guardian,
            'parent_phone'  => $resource->parent_phone,
            'father_name'  => $resource->father_name,
            'mother_name'  => $resource->mother_name,
            'father_job'  => $resource->father_job,
            'mother_job'  => $resource->mother_job,
            'parent_income'  => $resource->parent_income,
            'total_sibling'  => $resource->total_sibling,
            'created_at' => $resource->created_at->toAtomString(),
            'updated_at' => $resource->updated_at->toAtomString(),
            'trashed' => isset($resource->deleted_at) ? $resource->deleted_at->toAtomString() : 'false',
        ];
    }
}
