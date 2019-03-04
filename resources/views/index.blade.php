@extends('app')
@section('content')
<main class="app-content">
    <div class="col-12">
      <h2>Instrucciones</h2>
          <ul>
              <li>
                  <h2>Concesionarios</h2> 
                  <p>Permite ingresar nuevos o editar concesionarios ya existentes, no permite eliminacion de los mismo debido que es clave foranea y no esta contemplado en este proyecto. NOTA (Por Defecto 5 concesionarios cargados en la Base de Datos)</p>
                  <p><b>Nuevo Concesionario:</b> Es necesario elegir una ciudad de las ya listadas en la base de datos e ingresar el nombre del nuevo conecionario</p>
                  <p><b>Editar Concesionario:</b> Permite la modificacion del nombre o de la ciudad del Concesionario elegido</p>
              </li>
              <li>
                  <h2>Clientes</h2>                   
                  <p>Permite crear editar o cambiar status</p>
                  <p><b>Nuevo Cliente:</b> Es necesario elegir un concesionario de las ya listadas en la base de datos e ingresar los demas datos solicitados</p>
                  <p><b>Editar Cliente:</b> Permite cambiar los valores del mismo</p>
                  <p><b>Eliminar CLiente:</b> Permite cambiar el status del cliente</p>
              </li>

              <li>
                  <h2>Reporte Concesionario</h2>                   
                  <p>Permite buscar  reportes de clientes  por concesionarios (individual o consolidado)</p>
              </li>

              <li>
                  <h2>Reporte Ciudad</h2>                   
                  <p>Permite buscar  reportes de clientes  por Ciudad (individual o consolidado) NOTA(SOLO APARECERAN LAS CIUDADES DONDE ESTE AL MENOS UN CLIENTE REGISTRADO)</p>
              </li>
          </ul>
    </div>


</main>
@endsection

@section('scripts')
<script type="text/javascript">
</script>
@endsection

<style type="text/css">
  
  .hidden{
    display: none;
  }
</style>>
