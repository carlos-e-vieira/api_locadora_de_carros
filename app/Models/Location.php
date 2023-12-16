<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'car_id',
        'start_date',
        'expected_final_date',
        'final_date',
        'daily_value',
        'initial_km',
        'final_km',
    ];

    public function rules()
    {
        return [
            'customer_id' => 'exists:clientes,id',
            'car_id' => 'exists:carros,id',
            'start_date' => 'required|nullable|date',
            'expected_final_date' => 'required|nullable|date',
            'final_date' => 'nullable|date',
            'daily_value' => 'required',
            'initial_km' => 'required|integer',
            'final_km' => 'integer',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório'
        ];
    }
}
