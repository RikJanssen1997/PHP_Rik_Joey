<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeysForModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');

        });
        Schema::table('modules', function (Blueprint $table) {
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('modules', function (Blueprint $table){
            $table->dropForeign('modules_test_id_foreign');
        });
        Schema::table('modules', function (Blueprint $table){
            $table->dropForeign('modules_block_id_foreign');
        });
    }
}
