<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Creamos un array de departamentos 
        $arrayDepartamentos = [];
        //En este array de departamentos obtenemos todos los departamentos de la base de datos
        //mediante el uso de la sentencia Place:all() que recoge todos los puestos
        $arrayDepartamentos['departamentos'] = Departamento::all();
        //Devolvemos la vista con el array de departamentos
        return view('departamento.index', $arrayDepartamentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $arrayTrabajadores['trabajadores'] = Trabajador::all();
        //Le enviamos a la ventana de create
        return view('departamento.create',$arrayTrabajadores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validación del formulario 
        
        $request ->validate([
            'nombre' => 'required|min:2|max:100',
            'localizacion' => 'required|min:2|max:150',
        ]);
        
        //Aqui almacenaremo si se ha realizado la insercción de los datos o no
        $realizado ='';
        //Creamos un array de mensaje para que se almacene el mensaje que queremos 
        //mostrar indicando en todo momento al usuario si los datos han sido o no introducidos en la base de datos
        $mensaje = [];
        //Escribimos el mensaje a mostrar en caso de que haya salido todo correcto
        $mensaje['texto'] = 'El nuevo departamento ha sido insertado correctamente';
        //Este especifica el tipo de mensaje
        $mensaje['tipo'] = 'success';
        //Creamos un objeto departamento donde almacenaremos todos los datos que provienen 
        //del request con el metodo request all
        $departamentoGuardar = new Departamento($request->all());
        //Creamos un try catch para que en caso de que salte una excepcion cuando
        //se almacene el nuevo departamento en la base de datos realize una cosa u otra
        try {
            $realizado = $departamentoGuardar->save();
        } catch(\Exception $e) {
            $realizado = false;
        }
        
        //En caso de que no se hayan insertado los datos en la base de datos, mostrara
        //un mensaje y lo redirigira a la ventana puesto
        if(!$realizado) {
            $mensaje['texto'] = 'El nuevo departamento no se ha podido insertar';
            $mensaje['tipo'] = 'danger';
            return redirect('departamento')->with($mensaje);
        }
        return redirect('departamento')->with($mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        
        
        if(($departamento->idempleadojefe) != null){
        //Realizamos una sonsulta para obtene el nombre y apellido de ese trabajador
        $consultaNombres = DB::select('SELECT nombre, apellido FROM trabajador WHERE id =' . $departamento->idempleadojefe);
        
        //En caso de que borremos el trabajador no se actualizara aqui ya que no la relacion no es mediante el idempleadojefe
        //por ello si visualizamos el campo estar vacio, aqui le indicaremos que en tal caso muestre el resultado sin jefe 
            if(empty($consultaNombres)){
                $nombre = "";
                $apellido = "";
                $departamento -> idempleadojefe = null;

        
            }else{
            
                $nombre = $consultaNombres[0] -> nombre;
                $apellido = $consultaNombres[0] -> apellido;
                }

        }else{
            $nombre = "";
            $apellido = "";
        }
        
        
        //Lo enviamos a la ventana vista con los datos del departamento seleccionado
        return view('departamento.show', ['departamento' => $departamento ] , [ 'nombre' => $nombre, 'apellido' => $apellido]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        //Creamos un array de trabajadores para que el usuario pueda elegir el trabajador que sera jefe del departamento
        $arrayTrabajadores['trabajadores'] = Trabajador::all();
        //Lo enviamos a la ventana edit con los datos del departamento seleccionado
        return view('departamento.edit',$arrayTrabajadores, ['departamento' => $departamento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        //Validación del formulario 
        
        $request ->validate([
            'nombre' => 'required|min:2|max:100',
            'localizacion' => 'required|min:2|max:150',
        ]);
        
        //Aqui almacenaremo si se ha realizado la insercción de los datos o no
        $realizado ='';
        //Creamos un array de mensaje para que se almacene el mensaje que queremos 
        //mostrar indicando en todo momento al usuario si los datos han sido o no introducidos en la base de datos
        $mensaje = [];
        //Escribimos el mensaje a mostrar en caso de que haya salido todo correcto
        $mensaje['texto'] = 'El nuevo departamento ha sido modificado correctamente';
        //Este especifica el tipo de mensaje
        $mensaje['tipo'] = 'success';
       

       
        //Creamos un try catch para que en caso de que salte una excepcion cuando
        //se modifique el departamento en la base de datos realize una cosa u otra
        try {
            
            $realizado = $departamento->update($request->all());
        } catch(\Exception $e) {
            $realizado = false;
        }
        
        //En caso de que no se hayan modificaod los datos en la base de datos, mostrara
        //un mensaje y lo redirigira a la ventana puesto
        if(!$realizado) {
            $mensaje['texto'] = 'El departamento no se ha podido modificar';
            $mensaje['tipo'] = 'danger';
            return redirect('departamento')->with($mensaje);
        }
        return redirect('departamento')->with($mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        $mensaje = [];
        $mensaje['texto'] = 'El  departamento ' . $departamento->nombre .  ' ha sido borrado correctamente';
        $mensaje['tipo'] = 'success';
        
        
         try {
             //Con este metodo eliminamos el puesto en concreto, que nos llega. 
            $departamento->delete();
        } catch(\Exception $e) {
            $mensaje['texto'] = 'El  departamento ' . $departamento->nombre .  ' no ha sido borrado correctamente';
        $mensaje['tipo'] = 'danger';
        }
        return redirect('departamento')->with($mensaje);
    }
}
