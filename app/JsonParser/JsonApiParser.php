<?php

namespace App\JsonParser;

use League\Fractal\Serializer\JsonApiSerializer;

/**
 * Created by PhpStorm.
 * User: samina
 * Date: 12/15/16
 * Time: 1:28 PM
 */
class JsonApiParser extends JsonApiSerializer
{

    public function __construct()
    {

    }

    public function parseAttribute($data)
    {
        $resource = $data['data'];
        $attributes = (object)$resource['attributes'];
        $vars = get_object_vars($attributes);

        if (array_key_exists('attributes', $resource)) {
            foreach ($vars as $key => $val) {
                if (strpos($key, "-") !== false) {
                    $newKey = str_replace("-", "_", $key);
                    $attributes->{$newKey} = $val;
                    unset($attributes->{$key});
                }
            }
        }
        return (array)$attributes;
    }
}