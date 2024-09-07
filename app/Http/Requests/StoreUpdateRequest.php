<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required','max:255'],
            'email' => ['required','email','unique:users,email','max:255'],
            'bio' => ['nullable'],
            'thumb' => ['nullable','max:2048','mimes:jpeg,jpg,png'],
            'type' => ['required', 'in:mentor,mentee'],
            'password' => ['required','min:8'],
        ];

        if ($this->isMethod('patch') || $this->isMethod('put')) {

            $rules['email'] = ['required','email', "unique:users,email,{$this->id},id", 'max:255'];
            $rules['password'] = ['nullable', 'min:8'];
        }
    
        return $rules;
    }
}
