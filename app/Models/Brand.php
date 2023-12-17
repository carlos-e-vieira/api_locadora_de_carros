<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function rules(): array
    {
        return [
            'name' => 'required|', Rule::unique('brands')->ignore($this->id, 'id')
        ];
    }

    public function feedback(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'name.unique' => 'O nome da marca já existe',
            'name.min' => 'O nome deve ter no minímo 3 caracteres'
        ];
    }

    public function specification()
    {
        return $this->hasMany(Specification::class);
    }
}
