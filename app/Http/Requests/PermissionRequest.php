<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PermissionRequest extends FormRequest
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
          return $request->user()->canDo('user.permission.create');
      }
      // Determine if the user is authorized to update an entry.
      if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit')) {
          return $request->user()->canDo('user.permission.edit');
      }
      // Determine if the user is authorized to delete an entry.
      if ($request->isMethod('DELETE') || $request->is('*/destroy')) {
          return $request->user()->canDo('user.permission.delete');
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
          'name' => 'required|unique:permissions',
          'slug' => 'required|unique:permissions'
        ];
      }
      if ($request->isMethod('POST') && $request->is('*/update')) {
        return [
            'name' => 'required|unique:permissions,id,'.$request->get('id'),
            'slug' => 'unique:permissions,id,'.$request->get('id')
        ];
      }
      return [
          //
      ];
    }
}
