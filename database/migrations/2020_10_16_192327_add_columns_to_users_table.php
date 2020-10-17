<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('login', 40);
            $table->string('avatar_url', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('telephone', 30)->nullable();
            $table->boolean('gender')->nullable();
            $table->integer('age')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('login');
            $table->dropColumn('avatar_url');
            $table->dropColumn('description');
            $table->dropColumn('telephone');
            $table->dropColumn('gender');
            $table->dropColumn('age');
        });
    }
}
