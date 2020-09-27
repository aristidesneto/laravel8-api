<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
//            $table->unsignedBigInteger('user_id');
            $table->uuid('uuid')->index();
            $table->string('bloco');
            $table->string('apartamento')->comment('Número do apartamento');
            $table->enum('tipo', ['proprietario', 'inquilino', 'morador']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tenant_id')->references('id')->on('tenants');
//            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residents');
    }
}
