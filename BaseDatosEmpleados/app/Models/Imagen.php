<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    
    protected $table = 'imagen';
    
    public $timestamps = false;
    
    //Especificamos los campos de la tabla que esperamos recibir 
    //cuando vallamos a dar de alta a un performance
    protected $fillable = ['idtrabajador', 'nombre', 'mimetype','archivo',];
    
    
    public function trabajador (){
        return $this->belongsTo ('App\Models\Trabajador', 'idtrabajador');
    }
    
    
}
