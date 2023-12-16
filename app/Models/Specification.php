<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Specification extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id', 
        'name', 
        'image', 
        'doors', 
        'seats', 
        'air_bag', 
        'abs'
    ];

    public function rules(): array
    {
        return [
            'brand_id' => 'exists:marcas,id',
            'name' => 'required|', Rule::unique('modelos')->ignore($this->id, 'id'). '|min:3',
            'image' => 'required|file|mimes:png,jpeg,jpg',
            'doors' => 'required|integer|digits_between:1,5',
            'seats' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean'
        ];
    }

    public function feedback(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'name.unique' => 'O nome da marca já existe',
            'name.min' => 'O nome deve ter no minímo 3 caracteres',
            'image.mimes' => 'O arquivo deve ser uma imagem PNG, JPEG ou JPG',
            'doors.digits_between' => 'O número de portas deve ser entre 1 e 5',
            'seats.digits_between' => 'O número de lugares deve ser entre 1 e 20',
        ];
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
