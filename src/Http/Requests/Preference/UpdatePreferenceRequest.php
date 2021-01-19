<?php

namespace Akkurate\LaravelAccountSubmodule\Http\Requests\Preference;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePreferenceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'pagination' => ['required', 'digit', 'min:1', 'max:500'],
            'language_id' => ['required', 'numeric']
        ];
    }
}
