<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $action = $this->route()->getActionMethod();

        if ($action === 'update') {
            return $this->onPut();
        }

        if ($action === 'post') {
            return $this->onPost();
        }

        return $this->onGet();
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'name.min' => 'O nome deve ter 3 caracteres no minímo',
            'name.max' => 'O nome deve ter 40 caracteres no máximo',
            'cpf.min' => 'O CPF deve ter 11 caracteres',
            'cpf.max' => 'O CPF deve ter 11 caracteres'
        ];
    }

    private function onPost(): array
    {
        return [
            'name' => 'required|min:3|max:30',
            'cpf' => 'required|min:11|max:11|' . Rule::unique('customers', 'cpf')
        ];
    }

    private function onPut(): array
    {
        return [
            'name' => 'required|min:3|max:30',
            'cpf' => 'required|min:11|max:11|' . Rule::unique('customers', 'cpf')->ignore($this->id)
        ];
    }

    private function onGet(): array
    {
        return [
            'name' => 'nullable'
        ];
    }
}
