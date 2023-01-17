<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTxtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_txt', function (Blueprint $table) {
            $table->id();
            $table->string("service_name",191)->nullable()->index();
            $table->string("status_code",191)->nullable()->index();
            $table->string("route",191);
            $table->string("method",20);
            $table->string("created_date",191)->nullable()->index();
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
        Schema::dropIfExists('logs_txt');
    }
}
