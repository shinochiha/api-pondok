<?php

namespace App\Http\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;
use Neomerx\JsonApi\Schema\Identifier;

class EducationSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'education';
    }

    public function getId($education): ?string
    {
        return $education->id;
    }

    public function getAttributes($education): iterable
    {
        return [
            'pre_elementary' => $education->pre_elementary,
            'elementary'  => $education->elementary,
            'junior_high'  => $education->junior_high,
            'senior_high'  => $education->senior_high,
            'other'  => $education->other,
            'latest_major'  => $education->latest_major,
        ];
    }

    public function getRelationships($education): iterable
    {
        return [
         //    'profile' => [
         //        self::RELATIONSHIP_DATA => new Identifier($education->profile_id, 'profile'),
         //    ],
        ];
    }
}
