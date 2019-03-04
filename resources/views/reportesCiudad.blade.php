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
              <form action="{{ action('ReporteController@reporteCiudad') }}" method="POST" id="form-cliente">
                <div class="row">
                    <div class="col-md-6 offset-3">
                      <div class="form-group">  
                        <label for="concesionario">Ciudad</label>
                        <select class="form-control" id="ciudadId" name="ciudadId" style="width: 100%">
                        </select>
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


    @if (isset($ciudades))

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body row">

              @if (count($ciudades)!=0)
                    @foreach ($ciudades as $ciudad)
                      @if(isset($ciudad['concesionarios'][0]['clientesCiudad'][0]))
                      <div class="col-12"><h4>{{$ciudad['ciudad']}}</h4></div>
                          <div class="table-responsive" style="margin-bottom: 50px">
                            <table class="table">
                              <thead class="thead-dark">
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
                      <div class="alert alert-warning col-12 text-center" role="alert" style="margin-bottom: 50px">
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
@endsection

@section('scripts')

    
  <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
   
<script type="text/javascript">

            /*SELECT2 CONCESIONARIO REST API*/
              $.ajax( {
                  url: "{{ action('CiudadController@index') }}",
                  dataType: 'json',
              }).done(function(data){
              result = $.map(data.content, function (option) {
                    return {
                        id: option.id,
                        text: option.ciudad
                    };
                });
          /*FIN SELEC2  CONCESIONARIO REST API*/

          /*FIN SELEC2 */
                $("#ciudadId").select2({
                  placeholder: {
                    id: '',
                    text: 'Seleccione un Concesionario'
                  },
                  allowClear: true,
                    data: result,
                });
                
                //console.log("{{(isset($inputs['ciudadId'])) ? $inputs['ciudadId'] : ''}}")
                  $('#ciudadId').val("{{(isset($inputs['ciudadId'])) ? $inputs['ciudadId'] : ''}}").trigger('change');

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
