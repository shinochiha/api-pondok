<?php

namespace App\Http\Schemas;

use Neomerx\JsonApi\Schema\BaseSchema;
use Neomerx\JsonApi\Schema\Identifier;

class FamilySchema extends BaseSchema
{
    public function getType(): string
    {
        return 'family';
    }

    public function getId($family): ?string
    {
        return $family->id;
    }

    public function getAttributes($family): iterable
    {
        return [
            'living_parent' => $family->living_parent,
            'guardian'  => $family->guardian,
            'parent_phone'  => $family->parent_phone,
            'father_name'  => $family->father_name,
            'mother_name'  => $family->mother_name,
            'father_job'  => $family->father_job,
            'mother_job'  => $family->mother_job,
            'parent_income'  => $family->parent_income,
            'total_sibling'  => $family->total_sibling,
        ];
    }

    public function getRelationships($family): iterable
    {
        return [
         //    'profile' => [
         //        self::RELATIONSHIP_DATA => new Identifier($family->profile_id, 'profile'),
         //    ],
        ];
    }
}
