<?php

namespace App\Http\Controllers;
use Response;
use App\Cliente;
use App\StatusCode;
use App\Concesionario;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $respuesta['status']=StatusCode::where('codigo',200)->first();
        $respuesta['content'] = Cliente::with('concesionarios_clientes')->orderBy('apellido')->where('status',1)->get();

        return Response::json($respuesta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $inputs = $request->all();


            $rule=array(
                'concesionarioId' => 'required|integer|exists:concesionarios,id',
                'email' => 'required|email|unique:clientes,email,'.$inputs['mail'],
                'nombre' => 'required|string',
                'apellido' => 'required|string', 
                'tipo_cedula' => 'required|integer|min:1|max:2', 
                'cedula' => 'required|integer|min:99999|max:99999999|unique:clientes,cedula,'.$inputs['cedula'],
                 );



        $validator = \Validator::make($inputs,$rule);
 
        if ($validator->fails())
        {   
            $respuesta['status']=StatusCode::where('codigo',204)->first();
            $respuesta['errores'] = $validator->messages();
            return Response::json($respuesta);
        }

        $cliente = new Cliente;
        $cliente->concesionarioId = $inputs['concesionarioId'];
        $cliente->email = addslashes($inputs['email']);
        $cliente->nombre = addslashes($inputs['nombre']);
        $cliente->apellido = addslashes($inputs['apellido']);
        $cliente->tipo_cedula = $inputs['tipo_cedula'];
        $cliente->cedula = $inputs['cedula'];



        $cliente->save();
        
        $respuesta['status']=StatusCode::where('codigo',201)->first();
        return Response::json($respuesta);
    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $respuesta['status']    =StatusCode::where('codigo',200)->first();
        $respuesta['content']   = Cliente::findOrFail($id);

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
                'id' => 'required|integer',
                'concesionarioId' => 'required|integer|exists:concesionarios,id',
                'email' => 'required|email|unique:clientes,email,'.$inputs['id'],
                'nombre' => 'required|string',
                'apellido' => 'required|string', 
                'tipo_cedula' => 'required|integer|min:1|max:2', 
                'cedula' => 'required|integer|min:99999|max:99999999|unique:clientes,cedula,'.$inputs['id'],
                 );

        $validator = \Validator::make($inputs,$rule);
 
        if ($validator->fails())
        {   
            $respuesta['status']=StatusCode::where('codigo',204)->first();
            $respuesta['errores'] = $validator->messages();
            return Response::json($respuesta);
        }

            //$decrypted_id = Crypt::decryptString($inputs['id']);  

            $cliente = Cliente::findOrFail($inputs['id']);


        
        $cliente->concesionarioId = $inputs['concesionarioId'];
        $cliente->email = addslashes($inputs['email']);
        $cliente->nombre = addslashes($inputs['nombre']);
        $cliente->apellido = addslashes($inputs['apellido']);
        $cliente->tipo_cedula = $inputs['tipo_cedula'];
        $cliente->cedula = $inputs['cedula'];  

        $cliente->save();
        
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
        $cliente = Cliente::findOrFail($id);
        if ($cliente->status==1) {
            $cliente->status=0;

        }elseif ($cliente->status==0) {
            $cliente->status=1 ;
        }
        $cliente->save();
        $respuesta['status']=StatusCode::where('codigo',200)->first();
        return Response::json($respuesta);  
    }


    public function reporte(Request $request){

        $inputs = $request->all();


        $clientes=Cliente::select('*')
                    ->when( $inputs['desde']!= null, function ($q) use ($inputs) 
                            {
                                return$q->where('created_at', '>=', date("Y-m-d H:i:s", strtotime($inputs['desde']." 00:00:00")));
                            })
                    ->when( $inputs['hasta']!= null, function ($q) use ($inputs) 
                            {
                                return$q->where('created_at', '<=', date("Y-m-d H:i:s", strtotime($inputs['hasta']." 23:59:59")));
                            })
                    ->when( !isset($inputs['inactivo']), function ($q) use ($inputs) 
                            {
                                return$q->where('status',true);
                            })
                    ->when( isset($inputs['concesionarioId']), function ($q) use ($inputs) 
                            {
                                return$q->where('concesionarioId','=',$inputs['concesionarioId']);
                            })
                    ->with('concesionarios_clientes')
                    ->get();



            if ( isset($inputs['pdf']) && (count($clientes)!=0) ) {
               // return view('reportes.concesionario',compact('clientes','inputs'));
                 $pdf = PDF::loadView('reportes.concesionario', compact('clientes','inputs'));
                return $pdf->stream('listado_concesionario');
            }         

        return view('reportes',compact('clientes','inputs'));

    }
}
