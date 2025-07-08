<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class preneur extends Model
{
        protected $fillable = ['n_matricule', 'nom'];

    public function bons()
    {
        return $this->hasMany(bon::class, 'preneur_id');
    }
}
