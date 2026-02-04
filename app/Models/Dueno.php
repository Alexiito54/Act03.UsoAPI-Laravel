<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dueno extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'duenos';
    protected $primaryKey = 'id_persona';
    
    protected $fillable = ['nombre', 'apellido'];

    public function animales()
    {
        return $this->hasMany(Animal::class, 'id_persona', 'id_persona');
    }
}
