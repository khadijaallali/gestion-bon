@extends('layouts.app')
@section('title', 'Aide & Support')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-5 mx-auto">
            <div class="card shadow rounded h-100">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0">Aide & Support</h3>
                </div>
                <div class="card-body">
                    <p>
                        Pour toute question ou problème, contactez notre équipe support :
                    </p>
                    <ul class="list-unstyled">
                        <li><strong>Email :</strong> <a href="mailto:support@autohall.com">support@autohall.com</a></li>
                        <li><strong>Téléphone :</strong> 05 22 00 00 00</li>
                    </ul>
                    <hr>
                    <p>
                        Notre équipe est disponible du lundi au vendredi, de 9h à 18h.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection