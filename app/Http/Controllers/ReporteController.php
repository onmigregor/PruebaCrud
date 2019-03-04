<?php

namespace App\Http\Controllers;
use Response;
use App\Cliente;
use App\StatusCode;
use App\Concesionario;
use App\Ciudad;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ReporteController extends Controller
{

    public function reporteConcesionario(Request $request){

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

        return view('reportesConcesionario',compact('clientes','inputs'));

    }


    public function reporteCiudad(Request $request){

             $inputs = $request->all();


            $rule=array(
                'ciudadId' => 'required|integer|exists:ciudades,id',
                );
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   

            $ciudades=Ciudad::select('*')
                    ->when( isset($inputs['ciudadId']), function ($q) use ($inputs) 
                            {
                                return$q->where('id','=',$inputs['ciudadId']);
                            })
                    ->with(array('concesionarios' => function($query) {
                                $query->orderBy('nombre');
                            }))
                    ->orderBy('ciudad')
                    ->get();

            if ( isset($inputs['pdf'])) {
               // return view('reportes.concesionario',compact('clientes','inputs'));
                 $pdf = PDF::loadView('reportes.ciudad', compact('ciudades','inputs'));
                return $pdf->stream('listado_ciudad');
            }     

            return view('reportesCiudad',compact('ciudades','inputs'));
        }
}
