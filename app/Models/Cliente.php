<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function personas()
    {
        return $this->belongsTo(Persona::class);
    }

    public function ventas()
    {
        return $this->belongsTo(Venta::class);
    }

    protected $fillable = [
        'persona_id'
    ];
}
