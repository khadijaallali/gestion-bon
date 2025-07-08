<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vehicule extends Model
{

 protected $fillable = [
        'n_vehicule',
        'marque',
        'modele',
    ];

    public function bons()
    {
        return $this->hasMany(bon::class, 'vehicule_id');
    }
}
