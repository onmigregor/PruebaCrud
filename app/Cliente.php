<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{

    protected $table = "clientes";

    protected $guarded = [];

    protected $dates = ['deleted_at'];

   protected $fillable = ['id', 'concesionarioId', 'email','nombre','apellido', 'tipo_cedula', 'cedula','status', 'created_at'];






    public function concesionarios_clientes() 
    {
        return $this->belongsTo('App\Concesionario' , 'concesionarioId', 'id')->select(['id','ciudadId', 'nombre'])->with('ciudades');
    } 
}
