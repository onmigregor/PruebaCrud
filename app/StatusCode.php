<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusCode extends Model
{

	protected $table = 'status_code';
    //
	protected $fillable = ['codigo', 'tipo', 'mensaje'];

	protected $hidden = ['id','created_at','updated_at'];
}
