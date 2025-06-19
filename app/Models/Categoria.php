<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function caracteristica()
    {
        return $this->belongsTo(Caracteristica::class);
    }

    public function producto()
    {
        return $this->belongsToMany(Producto::class)->withTimestamps();
    }

    protected $fillable = [
        'caracteristica_id'
    ];
}
