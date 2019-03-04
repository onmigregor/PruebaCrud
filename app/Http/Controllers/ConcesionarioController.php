<?php

namespace App\Http\Controllers;

use Response;
use App\Concesionario;
use App\StatusCode;
use Illuminate\Http\Request;

class ConcesionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $respuesta['status']=StatusCode::where('codigo',200)->first();
        $respuesta['content'] = Concesionario::with('ciudades')->where('status',1)->orderBy('nombre')->get();
         
        return Response::json($respuesta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();


            $rule=array(
                'ciudadId' => 'required|integer|exists:ciudades,id',
                'nombre' => 'required|string|unique:concesionarios,nombre,NULL,id,ciudadId,'.$inputs['ciudadId'].'',
                 );




        $validator = \Validator::make($inputs,$rule);
 
        if ($validator->fails())
        {   
            $respuesta['status']=StatusCode::where('codigo',204)->first();
            $respuesta['errores'] = $validator->messages();
            return Response::json($respuesta);
        }

        $concesionario = new Concesionario;
        $concesionario->ciudadId = $inputs['ciudadId'];
        $concesionario->nombre = addslashes($inputs['nombre']);


        $concesionario->save();
        
        $respuesta['status']=StatusCode::where('codigo',201)->first();
        return Response::json($respuesta);
    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $respuesta['status']    =StatusCode::where('codigo',200)->first();
        $respuesta['content']   = Concesionario::findOrFail($id);

        return Response::json($respuesta);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
            $rule=array(
                'id' => 'required',
                'ciudadId' => 'required|integer|exists:ciudades,id',
                'nombre' => 'required|string|unique:concesionarios,nombre,NULL,id,ciudadId,'.$inputs['ciudadId'].'',
                 );

        $validator = \Validator::make($inputs,$rule);
 
        if ($validator->fails())
        {   
            $respuesta['status']=StatusCode::where('codigo',204)->first();
            $respuesta['errores'] = $validator->messages();
            return Response::json($respuesta);
        }

            //$decrypted_id = Crypt::decryptString($inputs['id']);  

        $concesionario = Concesionario::findOrFail($inputs['id']);


        
        $concesionario->ciudadId = $inputs['ciudadId'];
        $concesionario->nombre = addslashes($inputs['nombre']);


        $concesionario->save();
        
        $respuesta['status']=StatusCode::where('codigo',202)->first();
        return Response::json($respuesta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $concesionario = Concesionario::findOrFail($id);
        if ($concesionario->status==1) {
            $concesionario->status=0;

        }elseif ($concesionario->status==0) {
            $concesionario->status=1 ;
        }
        $concesionario->save();
        $respuesta['status']=StatusCode::where('codigo',200)->first();
        return Response::json($respuesta); 
    }
}
