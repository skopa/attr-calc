<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitiveMethodParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitive_method_parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('competitive_method_calculation_id');
            $table->foreign('competitive_method_calculation_id', 'competitive_method_calculation_id_parameters_fk')
                ->references('id')
                ->on('competitive_method_calculations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('name');
            $table->integer('direction');
            $table->decimal('q_value', 10, 3);
            $table->decimal('analog_value', 10, 3);
            $table->decimal('own_value', 10, 3);
            $table->integer('index');

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
        Schema::dropIfExists('competitive_method_parameters');
    }
}
