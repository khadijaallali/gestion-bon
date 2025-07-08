<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bons', function (Blueprint $table) {
            $table->id();
                        $table->string('n_bon')->unique();
            $table->string('type_carburant');
            $table->double('quantite');
            $table->double('prix');
            $table->double('total');
            $table->date('date_bon');
            $table->date('date_saisie');
            $table->foreignId('site_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('service_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('preneur_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('vehicule_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('utilisateur_id')->constrained()->onDelete('restrict')->onUpdate('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bons');
    }
};
