@extends('app')
@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i>Clientes</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item active"><a href="#" id="nuevo-cliente">Nuevo cliente</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered  " id="cliente-table">
                <thead>
                  <tr>
                    <th>Apellido</th> 
                    <th>Nombre</th>
                    <th>Cedula</th>
                    <th>Email</th>
                    <th>Ciudad</th>
                    <th>Concesionario</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>



        <div class="modal fade bd-example-modal-lg" id="form-modal" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <form id="form-cliente">
                <div class="row">
                  
                     <input type="hidden"  id="id" value="" name="id" placeholder="">


                    <div class="form-group col-md-6 offset-md-3">
                      <label for="concesionarioId">Concesionario</label>
                      <select class="form-control" id="concesionarioId" name="concesionarioId" style="width: 100%">
                      </select>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" value="" id="nombre" name="nombre" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="apellido">Apellido</label>
                      <input type="text" class="form-control" value="" id="apellido" name="apellido" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" value="" id="email" name="email" placeholder="">
                    </div>
                    <div class="form-group col-4 col-md-2">
                      <label for="tipo_cedula"> Tipo</label>
                      <select type="text" class="form-control" value="" id="tipo_cedula" name="tipo_cedula">
                        <option value="1">V</option>
                        <option value="2">E</option>
                      </select>
                    </div>
                    <div class="form-group col-8 col-md-4">
                      <label for="cedula">Cedula</label>
                      <input type="text" class="form-control" value="" id="cedula" name="cedula" placeholder="">
                    </div>
                </div>
               </form>

               <div id="errores" class="hidden">
                <ul id="descripcion_errores" style="color: red">
                  
                </ul>
                 
               </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btn-submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>

    </main>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {

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
                console.log(result.length)
                $('#concesionarioId').val(0).trigger('change');
            } );
          /*FIN SELEC2 */




            /*DATATABLE*/
            $('#cliente-table').DataTable({
            processing: true,
            responsive: true,
            pagingType: "numbers",
            ajax: {
                    "url":  '{{ action('ClienteController@index') }}',
                    "type": "get",
                    "dataSrc": "content"
                    },
            columns: [
                {data: 'apellido', name: 'apellido'},
                {data: 'nombre', name: 'nombre'},

                {"render": function ( data, type, full, meta ) {

                    if (full.tipo_cedula==1) {

                      cedula='V-'+full.cedula
                    }
                    if (full.tipo_cedula==2) {

                       cedula='E-'+full.cedula
                    }
                      return cedula  ;
                }},
                {data: 'email', name: 'email'},

                {data: 'concesionarios_clientes.ciudades.ciudad', name: 'concesionarios_clientes.ciudades.ciudad'},
                {data: 'concesionarios_clientes.nombre', name: 'concesionarios_clientes.nombre'},
                {"render": function ( data, type, full, meta ) {


                      editar='<button style="margin-right:5px" data-toggle="tooltip" data-placement="top" title="Editar" type="button" class="editar edit-modal btn-primary  btn-editar" data-remote="{{url("cliente")}}/'+full.id+'/edit" ><span class="fa fa-edit"></span><span class="hidden-xs"></span></button>'

                      elimnar='<button style="margin-left:5px" data-toggle="tooltip" data-placement="top" title="Eliminar" type="button" class="editar edit-modal btn-danger  btn-delete" data-remote="{{url("cliente")}}/'+full.id+'" ><span class="fa fa-trash"></span><span class="hidden-xs"></span></button>'
                      return editar+elimnar  ;
                }},



            ],
        });
        /*FIN DATATABLE*/





        /*FUNCION GUARDAR USUARIO*/
        $("#btn-submit").click(function(){


            var dataString = $('#form-cliente').serialize();
              if ($("#btn-submit").hasClass('crear')) {
                ruta=  '{{ url('cliente') }}'
                method= 'POST'
              }
              if ($("#btn-submit").hasClass('editar')) {
                  ruta=  '{{ url('cliente') }}/update'
                  method= 'PUT'
              }
              
                $.ajax({
                        url:  ruta,
                        type: method,
                        dataType: 'json',
                        data: dataString,
                        success: function (data) {

                            if (data.status.codigo==204) {
                                $('#descripcion_errores').empty()
                                      $('#errores').show(); 
                                      $.each(data.errores, function(i, item) {
                                        $("#descripcion_errores").append("<li>"+item+"</li>");
                                     });
                            }
                            if(data.status.codigo==202 || data.status.codigo==201){
                              swal("Hecho", "La operacion fue realizada de manera exitosa","success");
                              $('#cliente-table').DataTable().ajax.reload();
                              $('#form-modal').modal('hide')
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Error", "No se pudo realizar la operacion", "error");
                        }
                    }) 
     


    });



         /*FIN FUNCION GUARDAR USUARIO*/




    /*FUNCION EDITAR USUARIO*/
    $('#cliente-table').on('click', '.btn-editar[data-remote]', function (e) { 
            e.preventDefault();
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = $(this).data('remote');
            // confirm then
       
                $.ajax({
                        url: url,
                        type: 'get',
                        dataType: 'json',
                        success: function (data) {
                            $('#descripcion_errores').empty()
                            $('#concesionarioId').val(data.content.concesionarioId).trigger('change');
                            $('#id').val(data.content.id)
                            $('#email').val(data.content.email)
                            $('#nombre').val(data.content.nombre)
                            $('#apellido').val(data.content.apellido)
                            $('#tipo_cedula').val(data.content.tipo_cedula)
                            $('#cedula').val(data.content.cedula)
                            $('#btn-submit').removeClass('crear').addClass('editar')
                            $('#form-modal').modal({backdrop: 'static', keyboard: false})
                            $('#modalTitle').html('Editar Cliente')
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Error", "No se pudo realizar la operacion", "error");
                        }
                    }) 
            
        });

    /*FIN FUNCION EDITAR USUARIO*/

    /*FUNCION ELIMINAR*/
        $('#cliente-table').on('click', '.btn-delete[data-remote]', function (e) { 
            e.preventDefault();
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = $(this).data('remote');
            // confirm then
            console.log(url)
            swal({
            title: 'Desea eliminar este dato',
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText:'Cancelar',
            showLoaderOnConfirm: true,
                preConfirm: () => {
                console.log(url)
                $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true},
                        success: function () {
                            swal("Hecho", "La operacion fue realizada de manera exitosa","success");
                              $('#cliente-table').DataTable().ajax.reload();
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Error", "No se pudo realizar la operacion", "error");
                        }
                    }) 

                }
           });
            
        });


  } );
  /*FIN FUNCION ELIMINAR*/





    /*NUEVO FORMULARIO*/
    $("#nuevo-cliente").click(function(){
      $('#descripcion_errores').empty()
      $('#concesionarioId').val(0).trigger('change');
      $('#id').val('')
      $('#email').val('')
      $('#nombre').val('')
      $('#apellido').val('')
      $('#tipo_cedula').val('')
      $('#cedula').val('')
      $('#fechaNac').val('')
      $('#telefono').val('')
      $('#btn-submit').removeClass('editar').addClass('crear')
      $('#form-modal').modal({backdrop: 'static', keyboard: false})
      $('#modalTitle').html('Nuevo Cliente')

    });
     /*FIN NUEVO FORMULARIO*/








</script>
@endsection

<style type="text/css">
  
  .hidden{
    display: none;
  }
</style>>
