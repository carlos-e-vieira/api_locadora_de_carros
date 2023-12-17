<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf'
    ];

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:40',
            'cpf' => 'required|', Rule::unique('customers')->ignore($this->id, 'id')
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'name.min' => 'O nome deve ter 3 caracteres no minímo',
            'name.max' => 'O nome deve ter 40 caracteres no máximo',
            'cpf.min' => 'O CPF deve ter 11 caracteres',
            'cpf.max' => 'O CPF deve ter 11 caracteres'
        ];
    }
}
