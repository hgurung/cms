<?php
namespace App\Transformers;

use App\Model\Api\ApiUsers;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform(ApiUsers $users)
    {
        return [
            'id' => $users->id,
            'email' => $users->description,
            'status' => $users->username,
            'type' => $users->display_name,
            'created-at' => $users->created_at->toDateTimeString(),
            'updated-at' => $users->updated_at->toDateTimeString(),
        ];
    }
    
}
