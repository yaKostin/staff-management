<?php
namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest 
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'name' => 'required|min:2|max:64',
            'surname' => 'required|min:2|max:64',
            'patronymic' => 'required|min:2|max:64',
            'email' => 'required|email|max:120'
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
}