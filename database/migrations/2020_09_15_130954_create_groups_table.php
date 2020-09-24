<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('title')->default('')->nullable();
			$table->string('graphic')->default('true')->nullable();
			$table->integer('show_count')->default(6)->nullable();
			$table->integer('total_rate')->default(0)->nullable();
			$table->integer('invalid_rate')->default(0)->nullable();
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
