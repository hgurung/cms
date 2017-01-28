<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UsersRequest extends FormRequest
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
          return $request->user()->canDo('user.users.create');
      }
      // Determine if the user is authorized to update an entry.
      if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit') || $request->is('*/password')) {
          return $request->user()->canDo('user.users.edit');
      }
      // Determine if the user is authorized to delete an entry.
      if ($request->isMethod('DELETE') || $request->is('*/destroy')) {
          return $request->user()->canDo('user.users.delete');
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
            'name' => 'required|max:15',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users|max:10',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3',
            'roles' => 'required'
        ];
      }
      if ($request->isMethod('POST') && $request->is('*/update')) {
        return [
            'name' => 'required|max:15',
            'email' => 'required|email|unique:users,email,' . $request->get('id'),
            'username' => 'required|min:3|max:10|unique:users,username,' . $request->get('id'),
            'roles' => 'required'
        ];
      }
      if ($request->isMethod('POST') && $request->is('*/updatepassword')) {
        return [
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3'
        ];
      }
      return [
          //
      ];
    }
}
