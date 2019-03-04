<?php

namespace App\JsonApi\V1\Profiles;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'profiles';

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
            'fullname' => $resource->fullname,
            'gender'  => $resource->gender,
            'birth_place'  => $resource->birth_place,
            'birth_date'  => $resource->birth_date,
            'address'  => $resource->address,
            'city'  => $resource->city,
            'province'  => $resource->province,
            'phone' => $resource->phone,
            'wa'  => $resource->wa,
            'fb'  => $resource->fb,
            'hobby'  => $resource->hobby,
            'dream'  => $resource->dream,
            'idol'  => $resource->idol,
            'quran'  => $resource->quran,
            'photo'  => $resource->photo,
            'created_at' => $resource->created_at->toAtomString(),
            'updated_at' => $resource->updated_at->toAtomString(),
            'trashed' => isset($resource->deleted_at) ? $resource->deleted_at->toAtomString() : 'false',
        ];
    }

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'education' => [
                self::SHOW_SELF    => true,
                self::SHOW_RELATED => true,
                self::SHOW_DATA => isset($includeRelationships['education']),
                self::DATA => function () use ($resource) {
                    return $resource->education;
                }
            ],
            'family' => [
                self::SHOW_SELF    => true,
                self::SHOW_RELATED => true,
                self::SHOW_DATA => isset($includeRelationships['family']),
                self::DATA => function () use ($resource) {
                    return $resource->family;
                }
            ],
        ];
    }
}
