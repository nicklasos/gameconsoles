<?php

use App\Services\Migrations;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDevelopers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->text('description')->nullable();

            $table->date('founded_at')->nullable();

            Migrations::timestamps($table);
        });

        Schema::table('games', function (Blueprint $table) {
            $table->unsignedBigInteger('developer_id')->after('id')->default(0);

            $table->index('developer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developers');

        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('developer_id');
        });
    }
}
