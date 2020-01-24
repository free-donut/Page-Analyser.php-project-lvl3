<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration
{
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url_adress', 100);
            $table->string('state', 100)->nullable();
            $table->integer('status_code')->nullable();
            $table->integer('content_length')->nullable();
            $table->text('body')->nullable();
            $table->text('h1')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->timestamps(0);
        });
    }

    public function down()
    {
    	//Schema::rename('Domains', 'domains');
    	Schema::dropIfExists('Domains');
        Schema::dropIfExists('domains');
    }
}
