<?php

namespace App\Http\Controllers\Admin\config;

use Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;
use File;
use Carbon\Carbon;
use App\Language;
use App\Http\Requests\LanguageRequest;
class languageController extends Controller
{

    public function __construct(Language $language)
    {

        $this->pageTitle = "Language Configuration";
        $this->model = $language;
        $this->redirectUrl = PREFIX."/config/pages/language";

    }

    public function index()
    {
        $pageTitle = $this->pageTitle;
        $data = $this->model->getAllData(Input::all());
        return view('backend.language.index',compact('data','pageTitle'));
    }

    public function create(LanguageRequest $request)
    {
        return view('backend.language.create');
    }

    public function store(LanguageRequest $request)
    {
        try {
            $attributes         = $request->all();
            if (!empty($request->file('flag'))) {
                  $image = $request->file('flag');
                  $path = public_path().'/uploads/language/flag';
                  if(is_dir($path)!=true){
                    \File::makeDirectory($path, $mode = 0755, true);
                  }
                  $filename = uniqid().'.'.$request->file('flag')->getClientOriginalExtension();
                  $img = \Image::make($image->getRealPath());
                  $img->resize(100, 100, function ($constraint) {
          		        $constraint->aspectRatio();
          		    })->save($path.'/'.$filename);
                  $attributes['flag'] = $filename;
            }
            if (!empty($request->file('file'))) {
                  $filename = uniqid().'.'.$request->file('file')->getClientOriginalExtension();
                  $path = public_path().'/uploads/language/file';
                  if(is_dir($path)!=true){
                    \File::makeDirectory($path, $mode = 0755, true);
                  }
                  $request->file('file')->move(public_path('uploads/language/file/'), $filename);
                  $attributes['file'] = $filename;
            }
            $language           = $this->model->create($attributes);
            return redirect($this->redirectUrl)->withErrors(['alert-success'=>'Successfully Added']);
        } catch (Exception $e) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not saved!']);
        }
    }

    public function edit(LanguageRequest $request)
    {
        $pageTitle = $this->pageTitle;
        $data = $this->model->find(Input::get('id'));
        if(empty($data)){
          return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not found!']);
        }
        return view('backend.language.edit', compact('data','pageTitle'));
    }

    public function update(LanguageRequest $request)
    {
        $languageData = $this->model->where('id', $request->id)->first();
        try {
            $attributes         = $request->all();
            if (!empty($request->file('flag'))) {
                  if(null !== $languageData->flag && file_exists(public_path('uploads/language/flag/').$languageData->flag)){
                    \File::delete(public_path('uploads/language/flag/').$languageData->flag);
                  }
                  $image = $request->file('flag');
                  $filename = uniqid().'.'.$request->file('flag')->getClientOriginalExtension();
                  $destinationPath = public_path('uploads/language/flag');
                  $img = \Image::make($image->getRealPath());
                  $img->resize(100, 100, function ($constraint) {
          		        $constraint->aspectRatio();
          		    })->save($destinationPath.'/'.$filename);
                  $attributes['flag'] = $filename;
            }
            if (!empty($request->file('file'))) {
                  if(null !== $languageData->file && file_exists(public_path('uploads/language/file').$languageData->file)){
                    \File::delete(public_path('uploads/language/file').$languageData->file);
                  }
                  $filename = uniqid().'.'.$request->file('file')->getClientOriginalExtension();
                  $request->file('file')->move(public_path('uploads/language/file/'), $filename);
                  $attributes['file'] = $filename;
            }
            $languageData->update($attributes);
            return redirect($this->redirectUrl)->withErrors(['alert-success'=>'Successfully Updated']);
        } catch (Exception $e) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not saved!']);
        }

    }

    public function destroy(LanguageRequest $request)
    {
        try {
            $language = $this->model->find(Input::get('id'));
            if(null !== $language->flag && file_exists(public_path().'/uploads/language/flag/'.$language->flag)){
              \File::delete(public_path().'/uploads/language/flag/'.$language->flag);
            }
            if(null !== $language->file && file_exists(public_path().'/uploads/language/file/'.$language->file)){
              \File::delete(public_path().'/uploads/language/file/'.$language->file);
            }
            $t = $language->delete();
            return redirect()->back()->withErrors(['alert-success'=>'Successfully Deleted']);
        } catch (Exception $e) {
            return redirect()->back()->withErrors([$e->message]);
        }

    }

    public function active(LanguageRequest $request)
    {
      $language = $this->model->where('id',Input::get('id'))->first();
      if($language->status == 'active')
      {
        $language->status='inactive';
        $checked = "";
        if($language->save())
          echo '<input type="checkbox" data-on-color="primary" name="status" id="status_'.$language->id.'" class="input-switch status" data-id="'.$language->id.'" data-size="medium" data-on-text="Active" data-off-text="Inactive" '.$checked.'>
';
        else
          header('HTTP/1.1 500 Internal Server Error');
      }
      elseif($language->status == "inactive")
      {
        $language->status='active';
        $checked = "checked";
        if($language->save())
        echo '<input type="checkbox" data-on-color="primary" name="status" id="status_'.$language->id.'" class="input-switch status" data-id="'.$language->id.'" data-size="medium" data-on-text="Active" data-off-text="Inactive" '.$checked.'>
';
        else
          header('HTTP/1.1 500 Internal Server Error');
      }
      else
      {
        header('HTTP/1.1 400 Bad Request');
      }
      exit();

    }

    public function defaultLanguage()
    {
        $languageData = $this->model->where('id', Input::get('id'));
        try {
            $languageData->update($attributes);
            return redirect($this->redirectUrl)->withErrors(['alert-success'=>'Successfully Updated']);
        } catch (Exception $e) {
            return redirect($this->redirectUrl)->withErrors(['alert-danger'=>'Data was not saved!']);
        }

    }


}
