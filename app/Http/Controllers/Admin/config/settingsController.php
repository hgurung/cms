<?php
namespace App\Http\Controllers\Admin\config;

use Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use File;
use App\Setting;
use App\Http\Requests\SettingsRequest;

class settingsController extends Controller
{

  public function __construct(Setting $setting) {
    $this->pageTitle = "Language Configuration";
    $this->model = $setting;
    $this->redirectUrl = PREFIX."/config/pages/settings";
  }

  public function index() {
    $pageTitle = $this->pageTitle;
    $data = $this->getSettingData();
    $timezoneData = $this->getTimeZoneData();
    return view('backend.settings.index',compact('data','timezoneData','pageTitle'));
  }

  public function getSettingData(){
    if($this->model->count()>0){
      $data = $this->model->first();
    }
    else{
      $data = new \stdClass();
      $data->meta_title = "";
      $data->meta_keywords = "";
      $data->meta_descriptions = "";
      $data->phone1 = "";
      $data->phone2 = "";
      $data->mobile_no = "";
      $data->email = "";
      $data->public_email = "";
      $data->latitude = "";
      $data->longitude = "";
      $data->fb_link = "";
      $data->twitter_link = "";
      $data->youtube_link = "";
      $data->skype_link = "";
      $data->instagram_link = "";
      $data->main_title = "";
      $data->secondary_title = "";
      $data->time_zone = "";
    }
    return $data;
  }

  public function getTimeZoneData(){
    $path  = storage_path('json/timezone.json');
    $data  = json_decode(file_get_contents($path));
    $timezoneArray = array();
    foreach($data as $value=>$title){
      $timezoneArray[$value] = $title;
    }
    return $timezoneArray;
  }

  public function store(SettingsRequest $request){
    if($this->model->count()>0){
      $timezoneData = $this->model->first();
      try{
        $timezoneData->update($request->all());
        return redirect($this->redirectUrl)->withErrors(['alert-success'=>'Successfully Updated']);
      }
      catch (Exception $e) {
          return redirect()->back()->withErrors(['alert-danger'=>$e->message]);
      }

    }else{
      try{
        $this->model->create($request->all());
        return redirect($this->redirectUrl)->withErrors(['alert-success'=>'Successfully Created']);
      }
      catch (Exception $e) {
        return redirect()->back()->withErrors([$e->message]);
      }
    }
  }

}
