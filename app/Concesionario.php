<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concesionario extends Model
{

	use SoftDeletes;

    protected $table = "concesionarios";

    protected $guarded = [];

    protected $dates = ['deleted_at'];

   	protected $fillable = ['id', 'nombre','created_at'];



   	public function clientes() 
    {
        return $this->hasMany('App\Cliente' , 'id', 'concesionarioId')->select(['id', 'concesionarioId' , 'nombre','apellido','tipo_cedula','cedula']);
    } 

    public function clientesCiudad() 
    {
        return $this->hasMany('App\Cliente' , 'concesionarioId', 'id')->select(['id', 'concesionarioId' ,'email' ,'nombre','apellido','tipo_cedula','cedula'])->where('status',true);
    } 

    public function ciudades() 
    {
        return $this->belongsTo('App\Ciudad' , 'ciudadId', 'id')->select(['id', 'ciudad'])->orderBy('ciudad');
    }
}
