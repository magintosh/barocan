<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elections', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('group_id')->default('0')->nullable();
			$table->string('title')->default('')->nullable();
			$table->string('image')->default('')->nullable();
			$table->string('color')->default('')->nullable();
			$table->text('detail')->nullable();
			$table->integer('rate1')->default(0)->nullable();
			$table->integer('rate2')->default(0)->nullable();
			$table->integer('rate3')->default(0)->nullable();
			$table->integer('rate4')->default(0)->nullable();
			$table->integer('rate5')->default(0)->nullable();
			$table->integer('rate6')->default(0)->nullable();
			$table->integer('rate7')->default(0)->nullable();
			$table->integer('rate8')->default(0)->nullable();
			$table->integer('rate9')->default(0)->nullable();
			$table->integer('rate10')->default(0)->nullable();
			$table->integer('rate11')->default(0)->nullable();
			$table->integer('rate12')->default(0)->nullable();
			$table->integer('rate13')->default(0)->nullable();
			$table->integer('rate14')->default(0)->nullable();
			$table->integer('rate15')->default(0)->nullable();
			$table->integer('rate16')->default(0)->nullable();
			$table->integer('rate17')->default(0)->nullable();
			$table->integer('rate18')->default(0)->nullable();
			$table->integer('rate19')->default(0)->nullable();
			$table->integer('rate20')->default(0)->nullable();
            $table->integer('sort')->default('0')->nullable();
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
        Schema::dropIfExists('elections');
    }
}
