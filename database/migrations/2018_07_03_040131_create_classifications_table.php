<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('classification');
            $table->timestamps();
        });

        Schema::create('game_classifications', function (Blueprint $table) {
            $table->integer('game_id');
            $table->integer('classification_id');
            $table->primary(['game_id', 'classification_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifications');
        Schema::dropIfExists('game_classifications');
    }
}
