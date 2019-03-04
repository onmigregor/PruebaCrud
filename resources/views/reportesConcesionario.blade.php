@extends('app')
@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Reportes</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb side">

<!--           <li class="breadcrumb-item active"><a href="#" id="exportar-pdf">Exportar Pdf</a></li> -->

        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <form action="{{ action('ReporteController@reporteConcesionario') }}" method="POST" id="form-cliente">
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">  
                        <label for="concesionario">Concesionario</label>
                        <select class="form-control" id="concesionarioId" name="concesionarioId" style="width: 100%">
                        </select>
                      </div>
                      <div class="animated-checkbox">
                        <label>
                          <input name="inactivo" {{(isset($inputs['inactivo']))? 'checked':''}}  type="checkbox"><span class="label-text">Mostrar Inactivos</span>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group"> 
                        <label for="concesionario">Desde</label> 
                        <input class="form-control" name="desde" readonly="" value="{{(isset($inputs['desde'])) ? $inputs['desde'] : ''}}" id="desde" type="text" placeholder="Desde">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group"> 
                        <label for="concesionario">Hasta</label> 
                        <input class="form-control" name="hasta" readonly="" value="{{(isset($inputs['hasta'])) ? $inputs['hasta'] : ''}}" id="hasta" type="text" placeholder="Hasta">
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <button type="submit"  class="btn btn-primary"  type="button">Consultar</button>
                        
                    </div>

                    <div class="animated-checkbox col-12 text-center">
                        <label>
                          <input name="pdf" type="checkbox"><span class="label-text">Exportar PDF</span>
                        </label>
                    </div>



                </div>
              </form>
             
            </div>
          </div>
        </div>
      </div>



    @if (isset($clientes))
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body row">

              @if (count($clientes)!=0)
                    <div class="col-3 offset-6 text-right">
                      AGENCIA: 
                    </div>
                    <div class="col-3">
                      {{(isset($inputs['concesionarioId']))? $clientes[0]['concesionarios_clientes']['nombre']: 'TODAS'}}
                    </div>
                    <div class="col-3 offset-6   text-right">
                      DESDE: {{(isset($inputs['desde'])) ? $inputs['desde'] : 'N/A'}}
                    </div>
                    <div class="col-3">
                      HASTA: {{(isset($inputs['desde'])) ? $inputs['hasta'] : 'N/A'}}
                    </div>
                    <br>
                    <br>
                    <div class="table-responsive  ">
                      <table class="table">
                        <thead class="thead-dark">
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
                            @foreach ($clientes as $cliente)
                              <tr>
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
                    </div>
              @else
              <div class="alert alert-warning col-12 text-center" role="alert">
                <strong>Atención!</strong> NO existen registros!!
              </div>
              @endif

                
            </div>
          </div>
        </div>
      </div>
    @endif






    </main>
@endsection

@section('scripts')

    
  <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
   
<script type="text/javascript">

            /*SELECT2 CONCESIONARIO REST API*/
              $.ajax( {
                  url: "{{ action('ConcesionarioController@index') }}",
                  dataType: 'json',
              }).done(function(data){
              result = $.map(data.content, function (option) {
                    return {
                        id: option.id,
                        text: option.nombre+'-'+option.ciudades.ciudad
                    };
                });
          /*FIN SELEC2  CONCESIONARIO REST API*/

          /*FIN SELEC2 */
                $("#concesionarioId").select2({
                  placeholder: {
                    id: '',
                    text: 'Seleccione un Concesionario'
                  },
                  allowClear: true,
                    data: result,
                });
                
                //console.log("{{(isset($inputs['concesionarioId'])) ? $inputs['concesionarioId'] : ''}}")
                  $('#concesionarioId').val("{{(isset($inputs['concesionarioId'])) ? $inputs['concesionarioId'] : ''}}").trigger('change');

            } );
          /*FIN SELEC2 */


        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#desde').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            format: 'dd-mm-yyyy',
            maxDate: function () {
                return $('#hasta').val();
            }
        });
        $('#hasta').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
             format: 'dd-mm-yyyy',
            minDate: function () {
                return $('#desde').val();
            }
        });

</script>
@endsection
@section('styles')

  <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
 
<style type="text/css">
  
  .hidden{
    display: none;
  }
</style>
@endsection
