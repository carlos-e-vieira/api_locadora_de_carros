<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Carro extends Model
{
    use HasFactory;

    protected $fillable = [
        'modelo_id', 
        'placa', 
        'disponivel', 
        'km'
    ];

    public function rules()
    {
        return [
            'modelo_id' => 'required|exists:modelos,id',
            'placa' => 'required|', Rule::unique('carros')->ignore($this->id, 'id'), 
            'disponivel' => 'required|boolean',
            'km' => 'required|integer'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'placa.unique' => 'Essa placa já existe',
            'placa.min' => 'A placa deve ter 7 caracteres',
            'placa.max' => 'A placa deve ter 7 caracteres',
        ];
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }
}
