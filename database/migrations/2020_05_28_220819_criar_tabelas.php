<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // As tabelas são criadas todas juntas dentro desse método, e são criadas na ordem certa, sem conflitos
    // por conta das chaves estrangeiras.
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('sobrenome', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('telefone',50)->unique();
            $table->timestamp('data_de_criacao')->nullable();
            $table->boolean('adm')->default(false);
        });

        Schema::create('comidas', function (Blueprint $table) {
            $table->bigIncrements('id_comida');
            $table->string('nome_comida', 100);
            $table->decimal('preco_comida', 6, 2);
            $table->string('imagem_comida', 200);
            $table->string('descricao_comida', 200);
            $table->enum('nacionalidade_comida', ['alemanha', 'italia', 'japao']);
        });

        Schema::create('mesas', function (Blueprint $table) {
            $table->bigIncrements('id_mesa');
            $table->integer('qtd_cadeiras');
            $table->enum('tipo_mesa', ['normal', 'vip']);
            $table->decimal('preco_mesa', 6, 2);
            $table->boolean('reservada');
        });

        Schema::create('delivery', function (Blueprint $table) {
            $table->bigIncrements('id_delivery');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('cep_delivery', 50);
            $table->string('numero_delivery', 50);
            $table->string('complemento_delivery', 150)->nullable();
            $table->dateTime('data_entrega');
            $table->decimal('preco_total', 6,2);
        });

        Schema::create('delivery_item', function (Blueprint $table) {
            $table->bigIncrements('id_delivery_item');
            $table->unsignedBigInteger('id_delivery');
            $table->foreign('id_delivery')->references('id_delivery')->on('delivery');
            $table->unsignedBigInteger('id_comida');
            $table->foreign('id_comida')->references('id_comida')->on('comidas');
            $table->integer('quantidade_delivery');
            $table->decimal('preco_comida', 6, 2);
        });

        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id_reserva');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('cpf_user');
            $table->unsignedBigInteger('id_mesa');
            $table->foreign('id_mesa')->references('id_mesa')->on('mesas');
            $table->decimal('preco_total', 6, 2);
            $table->dateTime('data_reserva');
        });

        Schema::create('carrinho', function (Blueprint $table) {
            $table->bigIncrements('id_carrinho');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_comida');
            $table->foreign('id_comida')->references('id_comida')->on('comidas');
            $table->integer('quantidade_delivery');
        });

        Schema::create('contact_emails', function (Blueprint $table) {
            $table->bigIncrements('id_email_contato');
            $table->string('name');
            $table->string('email');
            $table->string('message');
            $table->timestamp('data_mensagem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */


    // Esse é o método que dá rollback nas tabelas. Ele realiza o rollback de cima para baixo para
    // não haver conflito de uma tabela ser deletada, mas possuir chave estrangeira em outra.
    public function down()
    {
        Schema::dropIfExists('contact_emails');
        Schema::dropIfExists('carrinho');
        Schema::dropIfExists('reservas');
        Schema::dropIfExists('delivery');
        Schema::dropIfExists('mesas');
        Schema::dropIfExists('comidas');
        Schema::dropIfExists('users');
    }
}
