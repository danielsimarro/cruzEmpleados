<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;
    
    protected $table = 'puesto';
    
    public $timestamps = false;
    
    //Especificamos los campos de la tabla que esperamos recibir 
    //cuando vallamos a dar de alta a un performance
    protected $fillable = ['nombre', 'minimo', 'maximo', ];
    
    //Podemos darle a determinados campos su valor determinado si no se reciben esos datos
    protected $attributes = ['minimo' => 0, 'maximo' => 0, ];
    
    //Declaramos un metodo que se llama trabajador, mediante este metodo 
    //vamos a obtener todos los empleados 
    //que pertenecen al departamento que le mandemos
    
    //Con el app escribimos su espacio de nombres
    public function trabajador () {
        return $this->hasMany ('App\Models\Trabajador', 'idpuesto');
    }
}
