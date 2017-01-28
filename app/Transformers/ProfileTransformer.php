<?php
namespace App\Transformers;

use App\Model\Api\ApiUsers;
use App\Model\Api\ApiUsersProfile;
use League\Fractal\TransformerAbstract;

class ProfileTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'user'
        ];


    public function transform(ApiUsersProfile $profile)
    {
        return [
            'id' => $profile->id,
            'description' => $profile->description,
            'username' => $profile->username,
            'display-name' => $profile->display_name,
            'twitter-id' => $profile->twitter_id,
            'facebook-id' => $profile->facebook_id,
            'facebook-url' => $profile->facebook_url,
            'twitter-url' => $profile->twitter_url,
            'user-id' => $profile->user_id,
            'city' => $profile->city,
            'country' => $profile->country,
            'address1' => $profile->address1,
            'address2' => $profile->address2,
            'phone' => $profile->phone,
            'profile-picture-image' => $profile->profile_picture_image,
            'cover-picture-image' => $profile->cover_picture_image,
            'created-at' => $profile->created_at->toDateTimeString(),
            'updated-at' => $profile->updated_at->toDateTimeString(),
            'email' => $profile->email,
        ];
    }

    public function includeUser(ApiUsersProfile $profile)
    {
        $user = ApiUsers::find($profile->user_id);
        $userTransformer = new UserTransformer();
        return $this->item($user, $userTransformer, 'user');
    }
}
