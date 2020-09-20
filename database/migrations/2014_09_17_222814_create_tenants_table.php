<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('cnpj')->unique();
            $table->string('email')->unique();
            $table->string('address');
            $table->string('address_number');
            $table->string('address_district');
            $table->string('cep', 8);
            $table->string('city');
            $table->string('state', 2);
            $table->string('avatar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
