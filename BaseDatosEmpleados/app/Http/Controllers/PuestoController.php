<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Creamos un array de puestos 
        $arrayPuestos = [];
        //En este array de puestos obtenemos todos los puestos de la base de datos
        //mediante el uso de la sentencia Place:all() que recoge todos los puestos
        $arrayPuestos['puestos'] = Puesto::all();
        //Devolvemos la vista con el array de puestos
        return view('puesto.index', $arrayPuestos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Le enviamos a la ventana de create
        return view('puesto.create');
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
            'minimo' => 'required|numeric|gte:0.01|lte:9999999.99',
            'maximo'   => 'required|gte:0.01|lte:9999999.99|numeric',
        ]);
       
        
        
        
        //Aqui almacenaremo si se ha realizado la insercción de los datos o no
        $realizado ='';
        //Creamos un array de mensaje para que se almacene el mensaje que queremos 
        //mostrar indicando en todo momento al usuario si los datos han sido o no introducidos en la base de datos
        $mensaje = [];
        //Escribimos el mensaje a mostrar en caso de que haya salido todo correcto
        $mensaje['texto'] = 'El nuevo puesto ha sido insertado correctamente';
        //Este especifica el tipo de mensaje
        $mensaje['tipo'] = 'success';
        //Creamos un objeto puesto donde almacenaremos todos los datos que provienen 
        //del request con el metodo request all
        $puestoGuardar = new Puesto($request->all());
        //Creamos un try catch para que en caso de que salte una excepcion cuando
        //se almacene el nuevo puesto en la base de datos realize una cosa u otra
        try {
            $realizado = $puestoGuardar->save();
        } catch(\Exception $e) {
            $realizado = false;
        }
        
        //En caso de que no se hayan insertado los datos en la base de datos, mostrara
        //un mensaje y lo redirigira a la ventana puesto
        if(!$realizado) {
            $mensaje['texto'] = 'El nuevo puesto no se ha podido insertar';
            $mensaje['tipo'] = 'danger';
            return redirect('puesto')->with($mensaje);
        }
        return redirect('puesto')->with($mensaje);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function show(Puesto $puesto)
    {
        //Lo enviamos a la ventana vista con los datos del puesto seleccionado
        return view('puesto.show', ['puesto' => $puesto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Puesto $puesto)
    {
        //Lo enviamos a la ventana edit con los datos del puesto seleccionado
        return view('puesto.edit', ['puesto' => $puesto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puesto $puesto)
    {
        
        //Validación del formulario 
        
        $request ->validate([
            'nombre' => 'required|min:2|max:40',
            'minimo' => 'required|numeric|gte:0.01|lte:9999999.99',
            'maximo'   => 'required|gte:0.01|lte:9999999.99|numeric',
        ]);
        
        
        //Aqui almacenaremo si se ha realizado la modificacion de los datos o no
        $realizado ='';
        //Creamos un array de mensaje para que se almacene el mensaje que queremos 
        //mostrar indicando en todo momento al usuario si los datos han sido o no introducidos en la base de datos
        $mensaje = [];
        //EScribimos el mensaje a mostrar
        $mensaje['texto'] = 'El  puesto ' . $puesto->nombre .  ' ha sido modificado correctamente';
        //Este especifica el tipo de mensaje
        $mensaje['tipo'] = 'success';
        
        //Creamos un try catch para que en caso de que salte una excepcion cuando
        //se modifique el  puesto en la base de datos realize una cosa u otra
        try {
            $realizado = $puesto->update($request->all());
        } catch(\Exception $e) {
            $realizado = false;
        }
        
        //En caso de que no se hayan modificado los datos en la base de datos, mostrara
        //un mensaje y lo redirigira a la ventana puesto
        if(!$realizado) {
            $mensaje['texto'] = 'El puesto no ha podido modificarse';
            $mensaje['tipo'] = 'danger';
            return redirect('puesto')->with($mensaje);
        }
        return redirect('puesto')->with($mensaje); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puesto $puesto)
    {
        
        $mensaje = [];
        $mensaje['texto'] = 'El  puesto ' . $puesto->nombre .  ' ha sido borrado correctamente';
        $mensaje['tipo'] = 'success';
        
         try {
             //Con este metodo eliminamos el puesto en concreto, que nos llega. 
            $puesto->delete();
        } catch(\Exception $e) {
            $mensaje['texto'] = 'El  puesto ' . $puesto->nombre .  ' no ha sido borrado correctamente';
        $mensaje['tipo'] = 'danger';
        }
        return redirect('puesto')->with($mensaje);
    }
}
