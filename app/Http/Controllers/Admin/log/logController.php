<?php

namespace App\Http\Controllers\Admin\log;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use Input;
use App\Log;
use App\Http\Requests\LogRequest;
class logController extends Controller
{

  public function __construct(Log $log)
  {
      $this->pageTitle = "Log Management";
      $this->model = $log;
      $this->redirectUrl = PREFIX."/log";
  }

  public function index()
  {
      $pageTitle = $this->pageTitle;
      $data = $this->model->getAllData(Input::all());
      return view('backend.log.index',compact('data','pageTitle'));
  }

  public function destroy(LogRequest $request){
    try {
        $logData = $this->model->find($request->id);
        $t = $logData->delete();
        return redirect()->back()->withErrors(['alert-success'=>'Successfully Deleted']);
    } catch (Exception $e) {
        return redirect()->back()->withErrors(['alert-danger'=>$e->message]);
    }
  }

}
