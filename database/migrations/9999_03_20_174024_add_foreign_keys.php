<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //--------------------- 1 a n ----------------------//

        Schema::table('shows', function (Blueprint $table) {
            $table->foreign('user_id', 'show-user')
                ->references('id')
                ->on('users');  //nome tabella da agganciare
        });

        Schema::table('seasons', function (Blueprint $table) {
            $table->foreign('show_id', 'season-show')
                ->references('id')
                ->on('shows');  //nome tabella da agganciare
        });
        Schema::table('episodes', function (Blueprint $table) {
            $table->foreign('season_id', 'episode-season')
                ->references('id')
                ->on('seasons');  //nome tabella da agganciare
        });


        // ------------------------- N a N ---------------------------//

        Schema::table('genre_show', function (Blueprint $table) {

            $table->foreign('show_id', 'gs-show')
                ->references('id')
                ->on('shows');  //nome tabella da agganciare

            $table->foreign('genre_id', 'gs-genre')
                ->references('id')
                ->on('genres');  //nome tabella da agganciare
        });

        Schema::table('actor_show', function (Blueprint $table) {

            $table->foreign('show_id', 'as-show')
                ->references('id')
                ->on('shows');  //nome tabella da agganciare

            $table->foreign('actor_id', 'as-actor')
                ->references('id')
                ->on('actors');  //nome tabella da agganciare
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //--------------------- 1 a n ----------------------//

        Schema::table('shows', function (Blueprint $table) {

            $table->dropForeign('show-user');
        });

        Schema::table('seasons', function (Blueprint $table) {

            $table->dropForeign('season-show');
        });

        Schema::table('episodes', function (Blueprint $table) {

            $table->dropForeign('episode-season');
        });


        // ------------------------- N a N ---------------------------//


        Schema::table('genre_show', function (Blueprint $table) {

            $table->dropForeign('gs-genre');
            $table->dropForeign('gs-show');
        });

        Schema::table('actor_show', function (Blueprint $table) {

            $table->dropForeign('as-actor');
            $table->dropForeign('as-show');
        });
    }
}
