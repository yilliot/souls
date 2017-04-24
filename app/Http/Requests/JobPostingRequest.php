<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (\Auth::user()->seller) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:191',
            'description' => 'required|max:191',
            'minutes' => 'required|integer',
            'amount' => 'required|numeric',
            'category_id' => 'required|digits:3',
            'photos' => 'required|array|between:1,4',
            'photos.*' => 'image',
            'areas' => 'required|array|min:1',
            'areas.*' => 'digits:7',
        ];
    }
}
