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
        'doors', 
        'seats', 
        'air_bag', 
        'abs'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
