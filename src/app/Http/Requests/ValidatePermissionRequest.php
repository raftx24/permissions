<?php

namespace LaravelEnso\Permissions\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidatePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', $this->nameUnique()],
            'description' => 'required',
            'type' => 'required',
            'is_default' => 'required',
            'roles' => 'array',
        ];
    }

    protected function nameUnique()
    {
        return Rule::unique('permissions', 'name')
            ->ignore(optional($this->route('permission'))->id);
    }
}
