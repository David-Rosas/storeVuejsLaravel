<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'roles';
    protected $fillable=['nombre', 'decripcion', 'condicion'];
    public $timestamps = false;
    
    public function users(){

        return $this->hasMany('App\User');
        
    }
}
