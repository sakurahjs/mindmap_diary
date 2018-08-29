<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mindmap_id')->unsigned();
            $table->integer('x')->default(0);
            $table->integer('y')->default(0);
            $table->integer('from')->default(-1);
            $table->string('text')->default('');
            $table->integer('width')->default(0);
            $table->integer('height')->default(0);
            $table->string('shape')->default('rectangle');
            $table->string('line_color')->default('black');
            $table->string('background')->default('yellow');
            $table->string('stroke_color')->default('black');
            $table->string('font')->default('Arial');
            $table->string('font_color')->default('black');
            $table->integer('font_size')->default('30');
            $table->string('image_url')->default('');
            $table->timestamps();
        });
        
        Schema::table('nodes', function (Blueprint $table) {
            $table->foreign('mindmap_id')->references('id')->on('mindmaps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodes');
    }
}
