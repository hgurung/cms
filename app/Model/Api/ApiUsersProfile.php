<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class ApiUsersProfile extends Model
{
    protected $table = 'api_users_profile';

    protected $fillable = [
        'description',
        'username',
        'email',
        'display_name',
        'twitter_id',
        'facebook_id',
        'twitter_url',
        'facebook_url',
        'user_id',
        'country',
        'city',
        'address1',
        'address2',
        'phone',
        'profile_picture_image',
        'cover_picture_image',
        'created_at',
        'updated_at'
    ];

    public function addProfile($profile)
    {
        return ApiUsersProfile::create($profile);
    }

    public function user()
    {
        return $this->belongsTo('App\Model\Api\ApiUsers','user_id','id');
    }

    public function getProfileByUserName($userName)
    {
    return ApiUsersProfile::where('username',$userName)->first();
    }

    public function getProfileById($profileId)
    {
        return ApiUsersProfile::where('id',$profileId)->first();
    }

    public function updateProfile($updateProfile,$id)
    {
        return ApiUsersProfile::where('id',$id)->update($updateProfile);
    }

    public function checkEmail($email)
    {
        return ApiUsersProfile::where('email',$email)->first();
    }
}