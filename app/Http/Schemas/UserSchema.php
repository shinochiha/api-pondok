<?php

namespace App\Http\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;

class UserSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'users';
    }

    public function getId($user): ?string
    {
        return $user->uuid;
    }

    public function getAttributes($user): iterable
    {
        return [
            'username' => $user->username,
            'email'  => $user->email,
        ];
    }

    public function getRelationships($user): iterable
    {
        return [
            'profile' => [
                self::RELATIONSHIP_LINKS_SELF    => true,
                self::RELATIONSHIP_LINKS_RELATED => true,

                // Data include supported as well as other cool features
                self::RELATIONSHIP_DATA => $user->profile,
            ],
        ];
    }
}
