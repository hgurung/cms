<?php
namespace App\Http\Controllers\Admin\home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class homeController extends Controller
{
  public function __construct()
  {
  }

  public $thisPageId = 'Dashboard';

  public $thisModuleId = "home";

  public function index() {
    $data['thisPageId'] = $this->thisPageId;
    $data['thisModuleId'] = $this->thisModuleId;
    return view("backend.home.index",compact('data'), $data);
  }
}
