<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->comment("Nome da pessoa");
            $table->string('sobrenome')->comment("Sobrenome da pessoa");
            $table->string('email')->unique()->comment("Email da pessoa");
            $table->string('telefone')->comment("Telefone da pessoa");
            $table->enum('tipo_pessoa', ["F", "J"])->comment("Tipo de pessoa, F => Física, J => Jurídica");
            $table->string('cpf', 14)->comment("CPF da pessoa");
            $table->string('cnpj', 18)->comment("CNPJ da pessoa");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
