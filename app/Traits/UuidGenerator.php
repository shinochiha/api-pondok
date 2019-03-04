<?php

namespace App\Traits;

use Webpatser\Uuid\Uuid;

trait UuidGenerator
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
