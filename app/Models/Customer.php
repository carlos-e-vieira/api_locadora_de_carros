<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:40'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'name.min' => 'O nome deve ter 3 caracteres no minímo',
            'name.min' => 'O nome deve ter 40 caracteres no máximo'
        ];
    }
}
