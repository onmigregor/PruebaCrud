<!DOCTYPE html>
<html lang="es">
  <body">
	<main>
		@if (isset($clientes))
	           	@if (count($clientes)!=0)
	 			
	           		
	                    <div class="" style="float: right; width: 30%">
	                      AGENCIA:<b> {{(isset($inputs['concesionarioId']))? $clientes[0]['concesionarios_clientes']['nombre']: 'TODAS'}}</b>
	                    </div>
	                    <br>
	                    <br>

	                    <div class="" style="float: right; width: 30%">
	                      DESDE: <b> {{(isset($inputs['desde'])) ? $inputs['desde'] : 'N/A'}}</b>
	                    </div>
	                      <br>
	                      <br>
	                    <div class="" style="float: right; width:30%">
	                      HASTA: <b> {{(isset($inputs['desde'])) ? $inputs['hasta'] : 'N/A'}}</b>
	                    </div>
	                    <br>
	                    <br>
	                    <br>
	                    <br>
	                      <table class="" style="width: 100%">
	                        <thead class="" style="background-color:  gray">
	                          <tr>
	                            @if(isset($inputs['inactivo']))
	                                <th>Estatus</th>
	                            @endif
	                                <th>Apellido, Nombre</th>
	                                <th>Correo</th>
	                                <th>Cedula</th>
	                            @if(!isset($inputs['concesionarioId']))
	                                <th>Ciudad</th>
	                                <th>Agencia</th>
	                            @endif
	                          </tr>
	                        </thead>
	                        <tbody>
	                            @foreach ($clientes as $key => $cliente)
	                              <tr style=" background-color:{{( ($key % 2) == 0)? '#d0d0d0':''}}	 ">
	                              @if(isset($inputs['inactivo']))
	                                <td>{{($cliente['status']==1)? 'Activo':'Inactivo'}}</td>
	                              @endif
	                                <td>{{$cliente['apellido']}}, {{$cliente['nombre']}}</td>
	                                <td>{{$cliente['email']}}</td>
	                                <td>{{($cliente['tipo_cedula']==1)? 'V-':'E-'}}{{$cliente['cedula']}}</td>
	                              @if(!isset($inputs['concesionarioId']))
	                                <td>{{$cliente['concesionarios_clientes']['ciudades']['ciudad']}}</td>
	                                <td>{{$cliente['concesionarios_clientes']['nombre']}}</td>
	                              @endif
	                              </tr>
	                            @endforeach
	                        </tbody>
	                      </table>
				@endif

	    @endif
		
	</main>		
  </body>
</html>


