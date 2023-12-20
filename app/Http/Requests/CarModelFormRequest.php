<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarModelFormRequest extends FormRequest
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
            'required' => 'O campo :attribute é obrigatório',
            'name.unique' => 'O nome do modelo já existe',
            'name.min' => 'O nome deve ter no minímo 3 caracteres',
            'doors.digits_between' => 'O número de portas deve ser entre 1 e 5',
            'seats.digits_between' => 'O número de lugares deve ser entre 1 e 20',
        ];
    }

    private function onPost(): array
    {
        return [
            'brand_id' => 'exists:brands,id',
            'name' => 'required|string|min:3|max:30|' . Rule::unique('car_models', 'name'),
            'doors' => 'required|integer|digits_between:1,5',
            'seats' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean'
        ];
    }

    private function onPut(): array
    {
        return [
            'brand_id' => 'exists:brands,id',
            'name' => 'required|string|min:3|max:30|' . Rule::unique('car_models', 'name')->ignore($this->id),
            'doors' => 'required|integer|digits_between:1,5',
            'seats' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean'
        ];
    }

    private function onGet(): array
    {
        return [
            'brand_id' => 'nullable', 
            'name' => 'nullable', 
            'doors' => 'nullable', 
            'seats' => 'nullable', 
            'air_bag' => 'nullable', 
            'abs' => 'nullable'
        ];
    }
}
