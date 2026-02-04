<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'animales';
    protected $primaryKey = 'id_animal';
    
    protected $fillable = [
        'nombre',
        'tipo',
        'peso',
        'enfermedad',
        'comentarios',
        'id_persona'
    ];


    public function dueno()
    {
        return $this->belongsTo(Dueno::class, 'id_persona', 'id_persona');
    }
}
