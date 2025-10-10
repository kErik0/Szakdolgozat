<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->user();
        if ($user instanceof User) {
            $uniqueRule = Rule::unique(User::class)->ignore($user->id);
        } elseif ($user instanceof Company) {
            $uniqueRule = Rule::unique(Company::class)->ignore($user->id);
        } else {
            $uniqueRule = Rule::unique(User::class);
        }

        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                $uniqueRule,
            ],
            'password' => ['nullable', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ];
    }
}
