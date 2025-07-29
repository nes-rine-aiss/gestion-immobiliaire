<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{

    public function rules(): array
    {
          return [
        'name'     => ['required', 'string', 'max:255'],
        'email'    => ['required', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
        'roles'    => ['required', 'array', 'min:1'],
        'roles.*'  => ['string', 'exists:roles,name'],
    ];
    }
}
