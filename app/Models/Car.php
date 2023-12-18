<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'specification_id', 
        'plate', 
        'availability', 
        'km'
    ];

    public function specification()
    {
        return $this->belongsTo(Specification::class);
    }
}
