<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
      // Determine if the user is authorized to create an entry,
      if ($request->isMethod('POST') || $request->is('*/store')) {
          return $request->user()->canDo('config.settings.create');
      }
      return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'phone1'=>'phone|mobile',
          'phone2'=>'sometimes|phone|mobile',
          'mobile_no'=>'sometimes|phone|mobile',
          'email'  =>  'email',
          'public_email'  =>  'email',
          'latitude'=>'latitude',
          'longitude'=>'longitude',
          'fb_link'=>'sometimes|url',
          'twitter_link'=>'sometimes|url',
          'youtube_link'=>'sometimes|url',
          'skype_link'=>'sometimes|url',
          'instagram_link'=>'sometimes|url'
        ];
    }

    public function messages()
    {
      return [
          'phone1.phone'  =>  'Phone no you entered is not valid!',
          'phone2.phone'  =>  'Phone no. you entered is not valid!',
          'phone2.mobile'  =>  'Mobile no you entered is not valid!',
          'mobile_no.phone'  =>  'Phone no. you entered is not valid!',
          'mobile_no.mobile'  =>  'Mobile no you entered is not valid!',
          'public_email.email'  =>  'Public Email Address is not valid!',
          'latitude.latitude'  => 'Latitude is not valid!',
          'longitude.longitude'  =>  'Longitude is not valid!',
          'fb_link.url' => 'Facebook Url is not valid!',
          'twitter_link.url' => 'Twitter Url is not valid!',
          'youtube_link.url' => 'Youtube Url is not valid!',
          'skype_link.url' => 'Skype Url is not valid!',
          'instagram_link.url' => 'Instagram Url is not valid!'
      ];
    }
}
