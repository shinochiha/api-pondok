<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Neomerx\JsonApi\Encoder\Encoder;
use Neomerx\JsonApi\Http\Query\BaseQueryParser as Parser;

class Controller extends BaseController
{
    protected function supportIndexFeatures(Request $req, Collection $users, Encoder $encoder)
    {
    	if (!empty($req->all())) {
            $parser = new Parser($req->all());
            foreach ($parser->getSorts() as $key => $value) {
                $temp = [$key => $value];
                if (empty($sorts))
                    $sorts[] = $temp;
                else
                    array_unshift($sorts, $temp);
            }
            foreach ($parser->getIncludes() as $key => $value) {
                $included[] = $key;
            }
            foreach ($parser->getFields() as $key => $value) {
                $fields[$key] = [];
                foreach ($value as $v) {
                    array_push($fields[$key], $v);
                }
            }
        }
        if (!empty($sorts)) {
            foreach ($sorts as $params) {
                foreach ($params as $key => $value) {
                    $users = ($value) ? $users->sortBy($key) : $users->sortByDesc($key) ;
                }
            }
        }
        if (!empty($included)) {
            $encoder->withIncludedPaths($included);
        }
        if (!empty($fields)) {
            $encoder->withFieldSets($fields);
        }
    }
}
