<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "settings";

    protected $fillable = ['meta_title','meta_keywords','meta_descriptions','phone1','phone2','mobile_no','email','public_email','latitude','longitude','fb_link','twitter_link','youtube_link','skype_link','instagram_link','main_title','secondary_title','time_zone'];

    protected $guarded = ['id', '_token'];
}
