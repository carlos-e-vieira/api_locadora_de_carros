<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarFormRequest extends FormRequest
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

        if ($action === 'store') {
            return $this->onPost();
        }

        return $this->onGet();
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'plate.unique' => 'Essa placa já existe',
            'plate.min' => 'A placa deve ter 7 caracteres',
            'plate.max' => 'A placa deve ter 7 caracteres'
        ];
    }

    private function onPost(): array
    {
        return [
            'specification_id' => 'required|exists:specifications,id',
            'plate' => 'required|min:7|max:7|' . Rule::unique('cars', 'plate'),
            'availability' => 'required|boolean',
            'km' => 'required|integer'
        ];
    }

    private function onPut(): array
    {
        return [
            'specification_id' => 'required|exists:specifications,id',
            'plate' => 'required|min:7|max:7|' . Rule::unique('cars', 'plate')->ignore($this->id),
            'availability' => 'required|boolean',
            'km' => 'required|integer'
        ];
    }

    private function onGet(): array
    {
        return [
            'specification_id' => 'nullable', 
            'plate' => 'nullable', 
            'availability' => 'nullable', 
            'km' => 'nullable'
        ];
    }
}
