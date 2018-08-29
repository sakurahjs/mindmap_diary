<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mindmap_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('role')->default('view');
            $table->string('state')->default('requested');
            $table->timestamps();
        });
        
        Schema::table('shares', function (Blueprint $table) {
            $table->foreign('mindmap_id')->references('id')->on('mindmaps');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shares');
    }
}
