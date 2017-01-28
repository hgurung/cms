<?php
namespace App\Providers;

use DB;
use Illuminate\Support\ServiceProvider;
use Auth;
class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
      view()->composer('backend.sidebar', function ($view) {
          $modules =  config('cmsconfig.modules');
          $modulePages =  config('cmsconfig.modulepages');
          $modulePermissions =  config('cmsconfig.modulepermissions');
          $moduleIcons =  config('cmsconfig.moduleicons');
          $userPermission                = Auth::user()->permission;
          $allData                       = [ ];
          if(Auth::user()->isSuperUser()){ //Checking if superuser or not
              foreach ($modules as $moduleID => $moduleTitle) {
                $arrayData['id']       = $moduleID;
                $arrayData['title']    = $moduleTitle;
                $arrayData['pages']    = count($modulePages[$moduleID]);
                $arrayData['subPages'] = $modulePages[$moduleID];
                foreach ($moduleIcons as $id => $icons) {
                  if ($id == $moduleID) {
                    $arrayData['icon'] = $icons;
                  }
                }
                array_push($allData, $arrayData);
              }
          }else{
            
            $permissions = Auth::user()->allUserPermission();
            $userPermission = array_intersect_key($permissions,$modules);
            foreach($userPermission as $k=>$module) {
              $arrayData['id']       = $k;
              $arrayData['title']    = $modules[$k];
              $subModule = array();
              $count = 0;
              foreach($modulePages[$k] as $subModuleId=>$subModuleTitle){
                $count++;
                foreach($module as $m=>$v){
                  if(preg_match("/\b$subModuleId\b/i", $m)) {
                    $subModule[$subModuleId] = $subModuleTitle;
                  }

                }
              }
              $arrayData['subPages'] = $subModule;
              $arrayData['pages']    = $count;
              foreach ($moduleIcons as $id => $icons) {
                if ($id == $k) {
                  $arrayData['icon'] = $icons;
                }
              }
              array_push($allData, $arrayData);
            }
          }
          $view->with('modulesPermission',$allData);
          return $allData;
      });
    }
}
