<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFloatToDecimals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attributes', function (Blueprint $table) {
            $table->decimal('min', 16, 8)->change();
            $table->decimal('max', 16, 8)->change();
            $table->decimal('parameter', 16, 8)->change();
        });

        Schema::table('project_attribute', function (Blueprint $table) {
            $table->decimal('value', 16, 8)->change();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attributes', function (Blueprint $table) {
            Schema::table('attributes', function (Blueprint $table) {
                $table->float('min')->change();
                $table->float('max')->change();
                $table->float('parameter')->change();
            });

            Schema::table('project_attribute', function (Blueprint $table) {
                $table->float('value')->change();;
            });
        });
    }
}
