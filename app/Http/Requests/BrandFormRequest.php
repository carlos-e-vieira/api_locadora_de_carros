<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandFormRequest extends FormRequest
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

        return $this->onPost();
    }

    public function messages(): array
    {
        return [
            'required' => 'Campo obrigatório.',
            'name.unique' => 'O nome da marca já existe',
            'name.min' => 'O nome deve ter 3 caracteres no mínimo',
            'name.max' => 'O nome deve ter 50 caracteres no máximo'
        ];
    }

    private function onPost(): array
    {
        return [
            'name' => 'required|string|min:2|max:30|' . Rule::unique('brands', 'name')
        ];
    }

    private function onPut(): array
    {
        return [
            'name' => 'required|string|min:2|max:100|' . Rule::unique('brands', 'name')->ignore($this->id)
        ];
    }
}
