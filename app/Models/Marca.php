<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem'
    ];

    public function rules(): array
    {
        return [
            'nome' => 'required|', Rule::unique('marcas')->ignore($this->id, 'id') ,
            'imagem' => 'required|file|mimes:png'
        ];
    }

    public function feedback(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'imagem.mimes' => 'O arquivo deve ser uma imagem PNG',
            'nome.unique' => 'O nome da marca já existe',
            'nome.min' => 'O nome deve ter no minímo 3 caracteres'
        ];
    }

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}
