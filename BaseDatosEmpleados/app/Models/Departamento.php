<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    
    protected $table = 'departamento';
    
    //Especificamos los campos de la tabla que esperamos recibir 
    //cuando vallamos a dar de alta a un performance
    protected $fillable = ['nombre', 'localizacion', 'idempleadojefe'];
    
    //Declaramos un metodo que se llama empleados, mediante este metodo 
    //vamos a obtener todos los trabajadores 
    //que pertenecen al puesto que le mandemos
    
    //Con el app escribimos su espacio de nombres
    public function trabajador () {
        return $this->hasMany ('App\Models\Trabajador', 'iddepartamento');
    }
    
    //Con este metodo podemos acceder a los elmentos de trabajadore a traves del idempleadojefe
    public function jefe () {
        return $this->belongsTo ('App\Models\Trabajador', 'idempleadojefe');
    }
    
    
}
