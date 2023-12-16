<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'specification_id', 
        'plate', 
        'availability', 
        'km'
    ];

    public function rules()
    {
        return [
            'specification_id' => 'required|exists:modelos,id',
            'plate' => 'required|', Rule::unique('carros')->ignore($this->id, 'id'), 
            'availability' => 'required|boolean',
            'km' => 'required|integer'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'plate.unique' => 'Essa placa já existe',
            'plate.min' => 'A placa deve ter 7 caracteres',
            'plate.max' => 'A placa deve ter 7 caracteres',
        ];
    }

    public function specification()
    {
        return $this->belongsTo(Specification::class);
    }
}
