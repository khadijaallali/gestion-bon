<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class utilisateur extends Model
{
   public function bons()
   {
       return $this->hasMany(bon::class, 'utilisateur_id');
   }
}
