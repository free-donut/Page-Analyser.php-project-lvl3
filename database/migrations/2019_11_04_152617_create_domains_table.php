<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Поля: id, name, updated_at, created_at.
        Schema::create('Domains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url_adress', 100);
            $table->integer('status_code')->nullable();
            $table->integer('content_length')->nullable();
            $table->text('body')->nullable();
            $table->text('h1')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Domains');
        //
    }
}
