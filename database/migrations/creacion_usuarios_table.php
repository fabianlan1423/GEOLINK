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
       

        Schema::create('glink.registro_users', function (Blueprint $table) {
            
            $table->id();
            $table->text('nombre');
            $table->text('correo');
            $table->text('contraseña');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('glink.registro_users');
    }
};
