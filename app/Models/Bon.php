<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Site;
use App\Models\Service;
use App\Models\Vehicule;
use App\Models\Preneur;
use App\Models\Utilisateur;

class Bon extends Model
{

     protected $fillable = [
        'n_bon',
        'type_carburant',
        'quantite',
        'prix',
        'total',
        'site_id',
        'service_id',
        'vehicule_id',
        'preneur_id',
        'date_bon',
        'date_saisie',
        'description',
        'utilisateur_id',
    ];

public function site()
{
    return $this->belongsTo(Site::class);
}

public function service()
{
    return $this->belongsTo(Service::class);
    
}

public function preneur()
{
    return $this->belongsTo(Preneur::class);
}

public function vehicule()
{
    return $this->belongsTo(Vehicule::class);

}

public function utilisateur()
{
    return $this->belongsTo(Utilisateur::class);
}

}