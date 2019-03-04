<?php

namespace App\Http\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;
// use Neomerx\JsonApi\Schema\Identifier;

class ProfileSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'profile';
    }

    public function getId($profile): ?string
    {
        return $profile->uuid;
    }

    public function getAttributes($profile): iterable
    {
        return [
            'fullname' => $profile->fullname,
            'gender'  => $profile->gender,
            'birth_place'  => $profile->birth_place,
            'birth_date'  => $profile->birth_date,
            'address'  => $profile->address,
            'city'  => $profile->city,
            'province'  => $profile->province,
            'phone' => $profile->phone,
            'wa'  => $profile->wa,
            'fb'  => $profile->fb,
            'hobby'  => $profile->hobby,
            'dream'  => $profile->dream,
            'idol'  => $profile->idol,
            'quran'  => $profile->quran,
            'photo'  => $profile->photo,
        ];
    }

    public function getRelationships($profile): iterable
    {
        return [
        	// 'user' => [
        	// 	self::RELATIONSHIP_DATA => new Identifier($profile->user_id, 'users'),
         //    ],
            'education' => [
                self::RELATIONSHIP_DATA => $profile->education,
                self::RELATIONSHIP_LINKS_SELF    => false,
                self::RELATIONSHIP_LINKS_RELATED => true,
            ],
            'family' => [
                self::RELATIONSHIP_DATA => $profile->family,
                self::RELATIONSHIP_LINKS_SELF    => false,
                self::RELATIONSHIP_LINKS_RELATED => true,
            ],
        ];
    }
}
