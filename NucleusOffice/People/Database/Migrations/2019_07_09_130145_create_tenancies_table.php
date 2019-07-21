<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenancies', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('uuid')->index();
            $table->string('name');
            $table->string('description')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tenancy_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tenancy_id');

            $table->primary(['user_id', 'tenancy_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tenancy_id')->references('id')->on('tenancies');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('current_tenancy_id')->default(1);

            $table->foreign('current_tenancy_id')->references('id')->on('tenancies');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->unsignedBigInteger('tenancy_id')->default(1);

            $table->foreign('tenancy_id')->references('id')->on('tenancies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tenancies');
        Schema::enableForeignKeyConstraints();
    }
}
