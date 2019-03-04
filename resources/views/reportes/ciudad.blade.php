<!DOCTYPE html>
<html lang="es">
  <body">
	<main>
    @if (isset($ciudades))

      <div class="">
        <div class="">
          <div class="">
            <div class="">

            @if (count($ciudades)!=0)
                    @foreach ($ciudades as $ciudad)
                      @if(isset($ciudad['concesionarios'][0]['clientesCiudad'][0]))
                      <div class=""><h4>{{$ciudad['ciudad']}}</h4></div>
                          <div class="" style="margin-bottom: 50px">
                            <table class="" style="width: 100%">
                              <thead class="">
                                <tr>
                                      <th style="width: 33%">Apellido, Nombre</th>
                                      <th style="width: 33%">Correo</th>
                                      <th style="width: 33%">Cedula</th>
                                       <th style="width: 33%">Concesionario</th>
                                </tr>
                              </thead>
                              <tbody>
                                  @foreach ($ciudad['concesionarios'] as $concesionario)
                                            @foreach ($concesionario['clientesCiudad'] as $cliente)                                  
                                            <tr>
                                              <td style="width: 33%">{{$cliente['apellido']}}, {{$cliente['nombre']}}</td>
                                              <td style="width: 33%">{{$cliente['email']}}</td>
                                              <td style="width: 33%">{{($cliente['tipo_cedula']==1)? 'V-':'E-'}}{{$cliente['cedula']}}</td>
                                              <td style="width: 33%">{{$concesionario['nombre']}}</td>
                                            </tr>
                                            @endforeach
                                  @endforeach
                              </tbody>
                            </table>
                          </div>
                      @endif
                    @endforeach
                    @if(!isset($ciudades[0]['concesionarios'][0]['clientesCiudad'][0]) && (isset($inputs['ciudadId'])))
                      <div class="" role="alert" style="margin-bottom: 50px">
                          <strong>Atención!</strong> NO existen registros para esta ciudad!!
                      </div>
                    @endif
            @endif

                
            </div>
          </div>
        </div>
      </div>
    @endif
		
	</main>		
  </body>
</html>


