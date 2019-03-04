<?php 
return [
    // 'media-type' => 'application/vnd.api+json',
    'schemas' => [
        App\Models\User::class => App\Http\Schemas\UserSchema::class,
        App\Models\Profile::class => App\Http\Schemas\ProfileSchema::class,
        App\Models\Family::class => App\Http\Schemas\FamilySchema::class,
        App\Models\Education::class => App\Http\Schemas\EducationSchema::class,
    ],
    // 'jsonapi' => false,
    'options' => JSON_PRETTY_PRINT,
    'urlPrefix' => url('v1'),
    // 'depth' => 3,
    'meta' => [
        'copyright' => 'Copyright 2019 PondokProgrammer Corp.',
        'authors' => 'Students',
    ],
    'encoders' => [
        'custom' => [
            'jsonapi' => '2.0',
            'options' => JSON_PRETTY_PRINT,
            'urlPrefix' => url('v1'),
            'meta' => [
                'apiVersion' => '2.0',
            ],
        ]
    ]
];
