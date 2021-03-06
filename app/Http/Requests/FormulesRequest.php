<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class FormulesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required|min:5|max:255'
            'nomFormule' => 'required|min:3',
            'prix' => 'required',
            'texte' => 'required|min:5',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
            'nomFormule' => 'Formule Name',
            'prix' => 'Price',
            'texte' => 'Recipe',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
            'nomFormule.required' => 'Must include the Formule Name field ',
            'prix.required' => 'Must include the Price for youre formule ',
            'texte.required' => 'Must include the Recipe for youre formule ',
        ];
    }
}
