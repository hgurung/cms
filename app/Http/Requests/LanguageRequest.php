<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {

      // Determine if the user is authorized to create an entry,
      if ($request->isMethod('POST') || $request->is('*/create')) {
          return $request->user()->canDo('config.language.create');
      }
      // Determine if the user is authorized to update an entry.
      if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit') || $request->is('*/active')) {
          return $request->user()->canDo('config.language.edit');
      }
      // Determine if the user is authorized to delete an entry.
      if ($request->isMethod('DELETE') || $request->is('*/destroy')) {
          return $request->user()->canDo('config.language.delete');
      }
      return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if ($request->isMethod('POST') && $request->is('*/store')) {
          return [
              'lang_for' => 'required',
              'default' => 'required',
              'flag' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              'status' => 'required',
              'title' => 'required|max:15',
              'file' =>'required|file|max:2048',
              'slug' => 'required|unique:languages|max:2|regex:/^.*(?=.*[a-z]).*$/|'
          ];
        }
        if ($request->isMethod('POST') && $request->is('*/update')) {
          return [
              'lang_for' => 'required',
              'default' => 'required',
              'flag' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              'status' => 'required',
              'title' => 'required|max:15',
              'slug' => 'required|max:2|regex:/^.*(?=.*[a-z]).*$/|unique:languages,slug,'.$request->get('id')
          ];
        }
        return [
            //
        ];
    }


    public function messages()
    {
        return [
            'lang_for.required' => 'Language For must be selected!',
            'default.required'  => 'Please Select Default Language',
            'slug.max'  => 'Slug must contain only two letters !'
        ];
    }
}
