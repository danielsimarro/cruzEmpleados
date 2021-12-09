<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;
    
    protected $table = 'trabajador';
    
    //Especificamos los campos de la tabla que esperamos recibir 
    //cuando vallamos a dar de alta a un performance
    protected $fillable = ['idpuesto', 'iddepartamento', 'nombre', 'apellido' , 'email' , 'telefono' , 'fechacontrato'];
    
    
    //Declaramos un metodo que se llama puesto y departamento, mediante este metodo 
    //vamos a obtener el puesto y el departamento
    //al que pertenece un empleado
    
    public function puesto (){
        return $this->belongsTo ('App\Models\Puesto', 'idpuesto');
    }
    
    public function departamento (){
        return $this->belongsTo ('App\Models\Departamento', 'iddepartamento');
    }
    
    public function imagen () {
        return $this->hasMany ('App\Models\Imagen', 'idtrabajador');
    }
}
