<?php
//Backend

Route::group(['prefix' => 'system','middleware'=>['auth','role','log']], function () {

  Route::group(['namespace' => 'Admin\\' . Request::segment(2) ], function () {

      Route::get('{module}/pages/{page}', Request::segment(4) . 'Controller@index')->middleware('permission:'.Request::segment(4));

      Route::get('{module}', Request::segment(2) . 'Controller@index')->middleware('permission:'.Request::segment(2));

      Route::get('{module}/{page}', Request::segment(2) . 'Controller@' . Request::segment(3))->middleware('permission:'.Request::segment(2));

      Route::post('{module}/{page}', Request::segment(2) . 'Controller@' . Request::segment(3))->middleware('permission:'.Request::segment(2));

      Route::get('{module}/{page}/{id}', Request::segment(2) . 'Controller@' . Request::segment(3))->middleware('permission:'.Request::segment(2));

      Route::get('{module}/pages/{page}/{id}', Request::segment(4) . 'Controller@' . Request::segment(5))->middleware('permission:'.Request::segment(4));

      Route::post('{module}/pages/{page}/{id}', Request::segment(4) . 'Controller@' . Request::segment(5))->middleware('permission:'.Request::segment(4));

      Route::get('{module}/pages/{page}/{abc}/{id}', Request::segment(4) . 'Controller@' . Request::segment(5))->middleware('permission:'.Request::segment(4));

      Route::post('{module}/pages/{page}/{abc}/{id}', Request::segment(4) . 'Controller@' . Request::segment(5))->middleware('permission:'.Request::segment(4));
  });

});

// Route::group(['prefix' => 'system','middleware'=>['auth','role']], function () {
//
//   Route::group(['namespace' => 'Admin\\' . Request::segment(2) ], function () {
//
//       Route::get('{module}/pages/{page}', Request::segment(4) . 'Controller@index');
//
//       Route::get('{module}', Request::segment(2) . 'Controller@index');
//
//       Route::get('{module}/{page}', Request::segment(2) . 'Controller@' . Request::segment(3));
//
//       Route::post('{module}/{page}', Request::segment(2) . 'Controller@' . Request::segment(3));
//
//       Route::get('{module}/{page}/{id}', Request::segment(2) . 'Controller@' . Request::segment(3));
//
//       Route::get('{module}/pages/{page}/{id}', Request::segment(4) . 'Controller@' . Request::segment(5));
//
//       Route::post('{module}/pages/{page}/{id}', Request::segment(4) . 'Controller@' . Request::segment(5));
//
//       Route::get('{module}/pages/{page}/{abc}/{id}', Request::segment(4) . 'Controller@' . Request::segment(5));
//
//       Route::post('{module}/pages/{page}/{abc}/{id}', Request::segment(4) . 'Controller@' . Request::segment(5));
//   });
//
// });
