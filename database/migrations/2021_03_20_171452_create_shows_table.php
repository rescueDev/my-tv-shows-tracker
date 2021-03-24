<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('overview');
            $table->date('first_air_date');
            $table->smallInteger('season_count')->unsigned()->nullable();
            $table->smallInteger('vote_average')->nullable();
            $table->string('poster')->nullable();
            $table->string('status')->nullable();
            $table->string('original_language');

            $table->bigInteger('user_id')->unsigned();
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
        Schema::dropIfExists('shows');
    }
}
