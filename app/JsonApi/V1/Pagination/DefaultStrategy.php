<?php

namespace App\JsonApi\V1\Pagination;

use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;

class DefaultStrategy extends StandardStrategy
{	
    public function __construct()
    {
        parent::__construct();
        $this->withUnderscoredMetaKeys()->withMetaKey('pagination');
    }

}
