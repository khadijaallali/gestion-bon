<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class site extends Model
{
   public function bons()
   {
       return $this->hasMany(bon::class, 'site_id');
   }

   protected $fillable = [
       'code_site',
         'nom_site',  
   ];
}
