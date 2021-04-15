<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitiveMethodValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitive_method_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('competitive_method_calculation_id');
            $table->foreign('competitive_method_calculation_id', 'competitive_method_calculation_id_values_fk')
                ->references('id')
                ->on('competitive_method_calculations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('key');
            $table->decimal('value');

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
        Schema::dropIfExists('competitive_method_values');
    }
}
