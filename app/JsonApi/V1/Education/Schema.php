<?php

namespace App\JsonApi\V1\Education;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'education';

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
            'pre_elementary' => $resource->pre_elementary,
            'elementary'  => $resource->elementary,
            'junior_high'  => $resource->junior_high,
            'senior_high'  => $resource->senior_high,
            'other_education'  => $resource->other_education,
            'latest_major'  => $resource->latest_major,
            'created_at' => $resource->created_at->toAtomString(),
            'updated_at' => $resource->updated_at->toAtomString(),
            'trashed' => isset($resource->deleted_at) ? $resource->deleted_at->toAtomString() : 'false',
        ];
    }
}
