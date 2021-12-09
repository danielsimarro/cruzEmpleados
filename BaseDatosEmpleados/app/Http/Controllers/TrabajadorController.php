<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use App\Models\Departamento;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Creamos un array de trabajadores 
        $arrayTrabajadores = [];
        //En este array de trabajadores obtenemos todos los trabajadores de la base de datos
        //mediante el uso de la sentencia Trabajador:all() que recoge todos los trabajadores
        $arrayTrabajadores['trabajadores'] = Trabajador::all();
        //Devolvemos la vista con el array de trabajador
        return view('trabajador.index', $arrayTrabajadores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Le enviamos a la ventana de create
        return view('trabajador.create', ['puestos' => Puesto::all()], ['departamentos' => Departamento::all()]);
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
            'nombre' => 'required|min:2|max:40',
            'telefono' => 'required|numeric|gte:0|lte:999999999',
            'apellido'   => 'required|min:2|max:80',
            'email' => 'required',
            'fechacontrato' => 'required',
            'idpuesto' => 'required',
            'iddepartamento' => 'required',
        ]);
        
        
        
        //Aqui almacenaremo si se ha realizado la insercción de los datos o no
        $realizado ='';
        //Creamos un array de mensaje para que se almacene el mensaje que queremos 
        //mostrar indicando en todo momento al usuario si los datos han sido o no introducidos en la base de datos
        $mensaje = [];
        //Escribimos el mensaje a mostrar en caso de que haya salido todo correcto
        $mensaje['texto'] = 'El nuevo trabajador ha sido insertado correctamente';
        //Este especifica el tipo de mensaje
        $mensaje['tipo'] = 'success';
        //Creamos un objeto trabajador donde almacenaremos todos los datos que provienen 
        //del request con el metodo request all
        $trabajadorGuardar = new Trabajador($request->all());
        //Creamos un try catch para que en caso de que salte una excepcion cuando
        //se almacene el nuevo puesto en la base de datos realize una cosa u otra
        try {
            $realizado = $trabajadorGuardar->save();
        } catch(\Exception $e) {
            $realizado = false;
        }
        
        //En caso de que no se hayan insertado los datos en la base de datos, mostrara
        //un mensaje y lo redirigira a la ventana puesto
        if(!$realizado) {
            $mensaje['texto'] = 'El nuevo trabajador no se ha podido insertar';
            $mensaje['tipo'] = 'danger';
            return redirect('trabajador')->with($mensaje);
        }
        return redirect('trabajador')->with($mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function show(Trabajador $trabajador)
    {
        
   
        $consultaPuesto = DB::select('SELECT nombre FROM puesto WHERE id =' . $trabajador->idpuesto);
        //Esto nos data un arry con la información en este caso al se uno solo nos dara un valor en el array,
        //por lo que le enviaremos el primer valor y el unico que es cero
        $puesto = ($consultaPuesto[0]-> nombre);
        
        $consultaDepart = DB::select('SELECT nombre FROM departamento WHERE id =' . $trabajador->iddepartamento);
        $departamento =  ($consultaDepart[0]-> nombre);
       
       
        //Lo enviamos a la ventana vista con los datos del trabajador seleccionado
        return view('trabajador.show', ['trabajador' => $trabajador], ['puesto' => $puesto, 'depart' => $departamento]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function edit(Trabajador $trabajador)
    {
        //Lo enviamos a la ventana edit con los datos del puesto seleccionado
        return view('trabajador.edit', ['trabajador' => $trabajador], ['puestos' => Puesto::all(), 'departamentos' => Departamento::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trabajador $trabajador)
    {
        //Validación del formulario 
        
        $request ->validate([
            'nombre' => 'required|min:2|max:40',
            'telefono' => 'required|numeric|gte:0|lte:999999999',
            'apellido'   => 'required|min:2|max:80',
            'email' => 'required',
            'fechacontrato' => 'required',
            'idpuesto' => 'required',
            'iddepartamento' => 'required',
        ]);
        
        //Aqui almacenaremo si se ha realizado la modificacion de los datos o no
        $realizado ='';
        //Creamos un array de mensaje para que se almacene el mensaje que queremos 
        //mostrar indicando en todo momento al usuario si los datos han sido o no introducidos en la base de datos
        $mensaje = [];
        //EScribimos el mensaje a mostrar
        $mensaje['texto'] = 'El  trabajador ' . $trabajador->nombre .  ' ha sido modificado correctamente';
        //Este especifica el tipo de mensaje
        $mensaje['tipo'] = 'success';
        
        //Creamos un try catch para que en caso de que salte una excepcion cuando
        //se modifique el trabajador en la base de datos realize una cosa u otra
        try {
            $realizado = $trabajador->update($request->all());
        } catch(\Exception $e) {
            $realizado = false;
        }
        
        //En caso de que no se hayan modificado los datos en la base de datos, mostrara
        //un mensaje y lo redirigira a la ventana puesto
        if(!$realizado) {
            $mensaje['texto'] = 'El trabajador no ha podido modificarse';
            $mensaje['tipo'] = 'danger';
            return redirect('trabajador')->with($mensaje);
        }
        return redirect('trabajador')->with($mensaje); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trabajador $trabajador)
    {
        $mensaje = [];
        $mensaje['texto'] = 'El  trabajador ' . $trabajador->nombre .  ' ha sido borrado correctamente';
        $mensaje['tipo'] = 'success';
        
         try {
             //Con este metodo eliminamos el trabajador en concreto, que nos llega. 
            $trabajador->delete();
        } catch(\Exception $e) {
            
        $mensaje['texto'] = 'El  trabajador ' . $trabajador->nombre .  ' no ha sido borrado correctamente';
        $mensaje['tipo'] = 'danger';
        }
        return redirect('trabajador')->with($mensaje);
    }
}
