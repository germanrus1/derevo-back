<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesForTreeFamily extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tree', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 255);
            $table->string('avatar_url', 255)->default('');
            $table->text('description');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tree_item', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->default('');
            $table->string('last_name', 255)->default('');
            $table->string('patronymic', 255)->default('');
            $table->date('data_of_birth')->default(null);
            $table->date('data_of_death')->default(null);
            $table->date('gender')->default(null);
            $table->unsignedBigInteger('father_parent_id')->default(null);
            $table->unsignedBigInteger('mother_parent_id')->default(null);
            $table->boolean('adopted')->default(null);
            $table->string('avatar_url', 255)->default('');
            $table->text('description');
            $table->unsignedBigInteger('tree_id');
            $table->foreign('tree_id')->references('id')->on('tree')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tree_item');
        Schema::dropIfExists('tree');
    }
}
