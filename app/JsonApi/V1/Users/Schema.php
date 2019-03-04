<?php

namespace App\JsonApi\V1\Users;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'users';

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
            'username' => $resource->username,
            'email'  => $resource->email,
            'created_at' => $resource->created_at->toAtomString(),
            'updated_at' => $resource->updated_at->toAtomString(),
            'trashed' => isset($resource->deleted_at) ? $resource->deleted_at->toAtomString() : 'false',
        ];
    }

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'profile' => [
                // self::DATA => $resource->profile,
                self::SHOW_SELF    => true,
                self::SHOW_RELATED => true,
                self::SHOW_DATA => isset($includeRelationships['profile']),
                self::DATA => function () use ($resource) {
                    return $resource->profile;
                }
            ],
        ];
    }

    public function getPrimaryMeta($resource)
    {
        return [
            'copyright' => 'Copyright 2019 PondokProgrammer Corp.',
            'authors' => 'Students',
        ];
    }
}
