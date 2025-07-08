<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Service extends Model
    {
        
    protected $fillable = ['code_service', 'nom_service'];

    
     public function bons()
   {
       return $this->hasMany(Bon::class, 'service_id');
   }

    }
