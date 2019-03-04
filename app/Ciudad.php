<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ciudad extends Model
{
    use SoftDeletes;

    protected $table = "ciudades";

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'ciudad'];





    public function concesionarios() 
    {
        return $this->hasMany('App\Concesionario' , 'ciudadId', 'id')->select(['id','ciudadId','nombre'])->with('clientesCiudad');
    } 
}
